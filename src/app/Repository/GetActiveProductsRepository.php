<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class GetActiveProductsRepository
{
    public function get(): LengthAwarePaginator
    {
        return Product::with('images')
            ->where('is_active', 'active')
            ->paginate(10);
    }
}
