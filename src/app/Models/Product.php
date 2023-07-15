<?php

namespace App\Models;

use App\Enums\ProductInStockEnum;
use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'in_stock',
        'is_active',
    ];

    protected $casts = [
        'in_stock' => ProductInStockEnum::class,
        'is_active' => ProductStatusEnum::class,
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
