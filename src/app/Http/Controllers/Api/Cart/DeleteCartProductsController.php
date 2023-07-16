<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Cart;

use App\Http\Requests\Cart\DeleteCartProduct;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteCartProductsController
{
    public function __invoke(DeleteCartProduct $request): JsonResponse
    {
        $products = $request->get('products');
        $cart = $request->user()->cart;
        $cart->products()->detach($products);

        return response()->json(
            ['message' => 'Success'],
            Response::HTTP_OK
        );
    }
}
