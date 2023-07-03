<?php

namespace App\Models;

use App\Models\Knowledge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory, SoftDeletes;

    public function knowledges(): HasMany
    {
        return $this->hasMany(Knowledge::class);
    }
}
