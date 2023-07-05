<?php

namespace App\Models;

use App\Models\User;
use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Knowledge extends Model
{
    use HasFactory, SoftDeletes;

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}