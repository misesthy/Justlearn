<?php

namespace App\Models;

use App\Models\User;
use App\Models\media;
use App\Models\status;
use App\Models\Service;
use App\Models\Category;
// use App\Traits\Enums\Status;
use App\Models\Priority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Ticket extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'title',
        'message',
        'status',
        'priority_id',
        'user_id'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function getAttachmentsAttribute()
    {
        return $this->getMedia('attachments');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Status::class, 'status_id');
    }


    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
    

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeFilterTickets($query)
    {
        $query->when(request()->input('priority'), function($query) {
                $query->whereHas('priority', function($query) {
                    $query->whereId(request()->input('priority'));
                });
            })
            ->when(request()->input('category'), function($query) {
                $query->whereHas('category', function($query) {
                    $query->whereId(request()->input('category'));
                });
            })
            ->when(request()->input('status'), function($query) {
                $query->whereHas('status', function($query) {
                    $query->whereId(request()->input('status'));
                });
            })
            ->when(request()->input('service'), function($query) {
                $query->whereHas('service', function($query) {
                    $query->whereId(request()->input('service'));
                });
            });
    }

    // /**
    //  * Archive the ticket
    //  *
    //  * @return self
    //  */
    // public function archive(): self
    // {
    //     $this->update([
    //         'status' => Status::ARCHIVED->value,
    //     ]);

    //     return $this;
    // }

    // /**
    //  * Close the ticket
    //  *
    //  * @return self
    //  */
    // public function close(): self
    // {
    //     $this->update([
    //         'status' => Status::CLOSED->value,
    //     ]);

    //     return $this;
    // }

    // /**
    //  * Reopen the ticket
    //  *
    //  * @return self
    //  */
    // public function reopen(): self
    // {
    //     $this->update([
    //         'status' => Status::OPEN->value,
    //     ]);

    //     return $this;
    // }

    // /**
    //  * Determine if the ticket is archived
    //  *
    //  * @return bool
    //  */
    // public function isArchived(): bool
    // {
    //     return $this->status == Status::ARCHIVED->value;
    // }

    // /**
    //  * Determine if the ticket is open
    //  *
    //  * @return bool
    //  */
    // public function isOpen(): bool
    // {
    //     return $this->status == Status::OPEN->value;
    // }

    // /**
    //  * Determine if the ticket is closed
    //  *
    //  * @return bool
    //  */
    // public function isClosed(): bool
    // {
    //     return ! $this->isOpen();
    // }

    // /**
    //  * Determine if the ticket is resolved
    //  *
    //  * @return bool
    //  */
    // public function isResolved(): bool
    // {
    //     return $this->is_resolved;
    // }

    // /**
    //  * Determine if the ticket is unresolved
    //  *
    //  * @return bool
    //  */
    // public function isUnresolved(): bool
    // {
    //     return ! $this->isResolved();
    // }

    // /**
    //  * Determine if the ticket is locked
    //  *
    //  * @return bool
    //  */
    // public function isLocked(): bool
    // {
    //     return $this->is_locked;
    // }

    // /**
    //  * Determine if the ticket is unresolved
    //  *
    //  * @return bool
    //  */
    // public function isUnlocked(): bool
    // {
    //     return ! $this->isLocked();
    // }

    // /**
    //  * Mark the ticket as resolved
    //  *
    //  * @return self
    //  */
    // public function markAsResolved(): self
    // {
    //     $this->update([
    //         'is_resolved' => true,
    //     ]);

    //     return $this;
    // }

    // /**
    //  * Mark the ticket as locked
    //  *
    //  * @return self
    //  */
    // public function markAsLocked(): self
    // {
    //     $this->update([
    //         'is_locked' => true,
    //     ]);

    //     return $this;
    // }

    // /**
    //  * Mark the ticket as locked
    //  *
    //  * @return self
    //  */
    // public function markAsUnlocked(): self
    // {
    //     $this->update([
    //         'is_locked' => false,
    //     ]);

    //     return $this;
    // }

    // /**
    //  * Mark the ticket as archived
    //  *
    //  * @return self
    //  */
    // public function markAsArchived(): self
    // {
    //     $this->archive();

    //     return $this;
    // }

    // /**
    //  * Close the ticket and mark it as resolved
    //  *
    //  * @return self
    //  */
    // public function closeAsResolved(): self
    // {
    //     $this->update([
    //         'status' => Status::CLOSED->value,
    //         'is_resolved' => true,
    //     ]);

    //     return $this;
    // }

    // /**
    //  * Close the ticket and mark it as unresolved
    //  *
    //  * @return self
    //  */
    // public function closeAsUnresolved(): self
    // {
    //     $this->update([
    //         'status' => Status::CLOSED->value,
    //         'is_resolved' => false,
    //     ]);

    //     return $this;
    // }

    // /**
    //  * Reopen the ticket and mark it as resolved
    //  *
    //  * @return self
    //  */
    // public function reopenAsUnresolved(): self
    // {
    //     $this->update([
    //         'status' => Status::OPEN->value,
    //         'is_resolved' => false,
    //     ]);

    //     return $this;
    // }

    // /**
    //  * Get closed tickets
    //  *
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeClosed(Builder $builder): Builder
    // {
    //     return $builder->where('status', Status::CLOSED->value);
    // }

    // /**
    //  * Get opened tickets
    //  *
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeOpened(Builder $builder): Builder
    // {
    //     return $builder->where('status', Status::OPEN->value);
    // }

    // /**
    //  * Get resolved tickets
    //  *
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeResolved(Builder $builder): Builder
    // {
    //     return $builder->where('is_resolved', true);
    // }

    // /**
    //  * Get unresolved tickets
    //  *
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeUnresolved(Builder $builder): Builder
    // {
    //     return $builder->where('is_resolved', false);
    // }

    // /**
    //  * Get locked tickets
    //  *
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeLocked(Builder $builder): Builder
    // {
    //     return $builder->where('is_locked', true);
    // }

    // /**
    //  * Get unlocked tickets
    //  *
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeUnlocked(Builder $builder): Builder
    // {
    //     return $builder->where('is_locked', false);
    // }

    // /**
    //  * Get custom priority tickets
    //  *
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeWithPriority(Builder $builder, string $priority): Builder
    // {
    //     return $builder->where('priority', $priority);
    // }

    // /**
    //  * Get low priority tickets
    //  *
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeWithLowPriority(Builder $builder): Builder
    // {
    //     return $builder->where('priority', Priority::LOW->value);
    // }

    // /**
    //  * Get normal priority tickets
    //  *
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeWithNormalPriority(Builder $builder): Builder
    // {
    //     return $builder->where('priority', Priority::NORMAL->value);
    // }

    // /**
    //  * Get high priority tickets
    //  *
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeWithHighPriority(Builder $builder): Builder
    // {
    //     return $builder->where('priority', Priority::HIGH->value);
    // }

}
