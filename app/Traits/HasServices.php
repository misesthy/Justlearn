<?php

namespace App\Traits;

use App\Models\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Models\Service as ModelsService;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasServices
{
    use HasPermissions;

    /** @var string */
    private $serviceClass;

    public static function bootHasServices()
    {
        static::deleting(function ($model) {
            if (method_exists($model, 'isForceDeleting') && ! $model->isForceDeleting()) {
                return;
            }

            $model->services()->detach();
        });
    }

    public function getServiceClass()
    {
        if (! isset($this->serviceClass)) {
            $this->serviceClass = app(PermissionRegistrar::class)->getServiceClass();
        }

        return $this->serviceClass;
    }

    public function scopeRole(Builder $query, $services, $guard = null): Builder
    {
        if ($services instanceof Collection) {
            $services = $services->all();
        }

        $services = array_map(function ($service) use ($guard) {
            if ($service instanceof Service) {
                return $service;
            }

            $method = is_numeric($service) ? 'findById' : 'findByName';

            return $this->getRoleClass()->{$method}($service, $guard ?: $this->getDefaultGuardName());
        }, Arr::wrap($services));

        return $query->whereHas('services', function (Builder $subQuery) use ($services) {
            $serviceClass = $this->getServiceClass();
            $key = (new $serviceClass())->getKeyName();
            $subQuery->whereIn(config('permission.table_names.roles').".$key", \array_column($services, $key));
        });
    }

    /**
     * Assign the given role to the model.
     *
     * @param array|string|int|\Spatie\Permission\Contracts\Role|\Illuminate\Support\Collection ...$roles
     *
     * @return $this
     */
    public function assignService(...$services)
    {
        $services = collect($services)
            ->flatten()
            ->reduce(function ($array, $service) {
                if (empty($service)) {
                    return $array;
                }

                $service = $this->getStoredService($service);
                if (! $service instanceof Service) {
                    return $array;
                }

                $this->ensureModelSharesGuard($service);

                $array[$service->getKey()] = PermissionRegistrar::$teams && ! is_a($this, Permission::class) ?
                    [PermissionRegistrar::$teamsKey => getPermissionsTeamId()] : [];

                return $array;
            }, []);

        $model = $this->getModel();

        if ($model->exists) {
            $this->services()->sync($services, false);
            $model->load('services');
        } else {
            $class = \get_class($model);

            $class::saved(
                function ($object) use ($services, $model) {
                    if ($model->getKey() != $object->getKey()) {
                        return;
                    }
                    $model->services()->sync($services, false);
                    $model->load('services');
                }
            );
        }

        if (is_a($this, get_class($this->getPermissionClass()))) {
            $this->forgetCachedPermissions();
        }

        return $this;
    }

    /**
     * Revoke the given service from the model.
     *
     * @param string|int|\Spatie\Permission\Contracts\Service $service
     */
    public function removeRole($service)
    {
        $this->services()->detach($this->getStoredService($service));

        $this->load('services');

        if (is_a($this, get_class($this->getPermissionClass()))) {
            $this->forgetCachedPermissions();
        }

        return $this;
    }

    /**
     * Remove all current services and set the given ones.
     *
     * @param  array|\Spatie\Permission\Contracts\Service|\Illuminate\Support\Collection|string|int  ...$services
     *
     * @return $this
     */
    public function syncServices(...$services)
    {
        $this->services()->detach();

        return $this->assignService($services);
    }

    /**
     * Determine if the model has (one of) the given service(s).
     *
     * @param string|int|array|\Spatie\Permission\Contracts\Service|\Illuminate\Support\Collection $services
     * @param string|null $guard
     * @return bool
     */
    public function hasService($services, string $guard = null): bool
    {
        $this->loadMissing('services');

        if (is_string($services) && false !== strpos($services, '|')) {
            $services = $this->convertPipeToArray($services);
        }

        if (is_string($services)) {
            return $guard
                ? $this->services->where('guard_name', $guard)->contains('name', $services)
                : $this->services->contains('name', $services);
        }

        if (is_int($services)) {
            $serviceClass = $this->getServiceClass();
            $key = (new $serviceClass())->getKeyName();

            return $guard
                ? $this->services->where('guard_name', $guard)->contains($key, $services)
                : $this->services->contains($key, $services);
        }

        if ($services instanceof Service) {
            return $this->roles->contains($services->getKeyName(), $services->getKey());
        }

        if (is_array($services)) {
            foreach ($services as $service) {
                if ($this->hasRole($service, $guard)) {
                    return true;
                }
            }

            return false;
        }

        return $services->intersect($guard ? $this->services->where('guard_name', $guard) : $this->services)->isNotEmpty();
    }

    /**
     * Determine if the model has any of the given role(s).
     *
     * Alias to hasRole() but without Guard controls
     *
     * @param string|int|array|\Spatie\Permission\Contracts\Role|\Illuminate\Support\Collection $roles
     *
     * @return bool
     */
    public function hasAnyService(...$services): bool
    {
        return $this->hasService($services);
    }

    /**
     * Determine if the model has all of the given role(s).
     *
     * @param  string|array|\Spatie\Permission\Contracts\Role|\Illuminate\Support\Collection  $roles
     * @param  string|null  $guard
     * @return bool
     */
    public function hasAllServices($services, string $guard = null): bool
    {
        $this->loadMissing('services');

        if (is_string($services) && false !== strpos($services, '|')) {
            $services = $this->convertPipeToArray($services);
        }

        if (is_string($services)) {
            return $guard
                ? $this->services->where('guard_name', $guard)->contains('name', $services)
                : $this->services->contains('name', $services);
        }

        if ($services instanceof Service) {
            return $this->services->contains($services->getKeyName(), $services->getKey());
        }

        $services = collect()->make($services)->map(function ($service) {
            return $service instanceof Service ? $service->name : $service;
        });

        return $services->intersect(
            $guard
                ? $this->services->where('guard_name', $guard)->pluck('name')
                : $this->getServiceNames()
        ) == $services;
    }

    /**
     * Determine if the model has exactly all of the given role(s).
     *
     * @param  string|array|\Spatie\Permission\Contracts\Role|\Illuminate\Support\Collection  $roles
     * @param  string|null  $guard
     * @return bool
     */
    public function hasExactServices($services, string $guard = null): bool
    {
        $this->loadMissing('services');

        if (is_string($services) && false !== strpos($services, '|')) {
            $services = $this->convertPipeToArray($services);
        }

        if (is_string($services)) {
            $services = [$services];
        }

        if ($services instanceof Service) {
            $services = [$services->name];
        }

        $services = collect()->make($services)->map(function ($service) {
            return $service instanceof Service ? $service->name : $service;
        });

        return $this->services->count() == $services->count() && $this->hasAllServices($services, $guard);
    }

    /**
     * Return all permissions directly coupled to the model.
     */
    public function getDirectPermissions(): Collection
    {
        return $this->permissions;
    }

    public function getServiceNames(): Collection
    {
        $this->loadMissing('services');

        return $this->roleservicess->pluck('name');
    }

    protected function getStoredService($service): Service
    {
        $serviceClass = $this->getServiceClass();

        if (is_numeric($service)) {
            return $serviceClass->findById($service, $this->getDefaultGuardName());
        }

        if (is_string($service)) {
            return $serviceClass->findByName($service, $this->getDefaultGuardName());
        }

        return $service;
    }

    protected function convertPipeToArray(string $pipeString)
    {
        $pipeString = trim($pipeString);

        if (strlen($pipeString) <= 2) {
            return $pipeString;
        }

        $quoteCharacter = substr($pipeString, 0, 1);
        $endCharacter = substr($quoteCharacter, -1, 1);

        if ($quoteCharacter !== $endCharacter) {
            return explode('|', $pipeString);
        }

        if (! in_array($quoteCharacter, ["'", '"'])) {
            return explode('|', $pipeString);
        }

        return explode('|', trim($pipeString, $quoteCharacter));
    }
}
