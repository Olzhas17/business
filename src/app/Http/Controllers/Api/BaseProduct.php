<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseProduct
{
    public function getProduct(int $id): Model|Collection|Builder|array|null
    {
        return Product::with('images')->find($id);
    }
}