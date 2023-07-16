<?php

declare(strict_types=1);

namespace App\Repository;

use App\Http\Requests\Product\ProductCreateRequest;
use App\Models\Product;

final class ProductCreateRepository
{
    public function create(ProductCreateRequest $productDto)
    {
        return Product::create($productDto->only(
            'name',
            'price',
            'description',
            'in_stock',
            'is_active'
        ));
    }
}