<?php

namespace App\Repository;

use App\Models\Cart;
use App\Models\Product;

abstract class BaseCartRepository
{
    public function recalculateCart(Cart $cart, array $products): void
    {
        [$totalPrice, $totalQuantity] = $this->getProductTotalPriceQuantity($products);

        $cart->setQuantity($totalQuantity)
            ->setTotalAmount($totalPrice)
            ->save();
    }

    public function getProductTotalPriceQuantity(mixed $products): array
    {
        $totalPrice = $totalQuantity = 0;
        foreach ($products as $index => $product) {
            $productObj = Product::find($index);
            $totalQuantity += (int)$product['quantity'];
            $totalPrice += (float)$productObj->price * (int)$product['quantity'];
        }

        return [$totalPrice, $totalQuantity];
    }
}