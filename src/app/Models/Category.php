<?php

namespace App\Models;

use app\Enums\CategoryStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $casts = [
      'status' => CategoryStatusEnum::class
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->with('children');
    }
}
