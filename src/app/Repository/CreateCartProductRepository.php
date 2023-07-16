<?php

namespace App\Repository;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CreateCartProductRepository
{
    public function create(Cart $cart, array $products): bool
    {
        try {
            $productsWithQuantity = collect($products)
                ->map(function ($product) {
                    return ['quantity' => $product['quantity']];
                });

            $cart->products()->sync($productsWithQuantity);

            [$totalPrice, $totalQuantity] = $this->getCartTotalPriceQuantity($products, $cart);

            $cart->setQuantity($totalQuantity)
                ->setTotalAmount($totalPrice)
                ->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }

        return true;
    }

    public function getCartTotalPriceQuantity(mixed $products, mixed $cart): array
    {
        $totalPrice = 0;
        $totalQuantity = 0;
        foreach ($products as $index => $product) {
            $productObj = Product::find($index);
            $totalQuantity += (int)$product['quantity'];
            $totalPrice += (int)$productObj->price * (int)$product['quantity'];
        }

        return [$totalPrice, $totalQuantity];
    }
}