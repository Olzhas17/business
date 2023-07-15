<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Cart\CartProductRequest;

class AddCartProductController
{
    public function __invoke(CartProductRequest $request): JsonResponse
    {
        $cart = $request->user()->cart;

        if ($cart === null) {
            $cart = Cart::create([
                'user_id' => $request->user()->id,
            ]);
        }

        $products = $request->get('products');
        $cart->products()->sync($products);

        $totalPrice = 0;
        foreach ($products as $product_id) {
            $product = Product::find($product_id);
            $totalPrice += $product->price;
        }

        $cart->setQuantity(count($products))
            ->setTotalAmount($totalPrice)
            ->save();

        return response()->json(
            ["message" => "Success"],
            Response::HTTP_OK
        );
    }
}
