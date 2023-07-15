<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Cart;

use App\Http\Resources\ProductsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetUserCartProductsController
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $products = $request->user()->cart->products;

        return ProductsResource::collection($products);
    }
}
