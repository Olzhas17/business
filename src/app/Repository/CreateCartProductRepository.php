<?php

namespace App\Repository;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

final class CreateCartProductRepository extends BaseCartRepository
{
    public function create(Cart $cart, array $products): bool
    {
        try {
            $productsWithQuantity = collect($products)
                ->map(function ($product) {
                    return ['quantity' => $product['quantity']];
                });
            $cart->products()->sync($productsWithQuantity);
            $this->recalculateCart($cart, $products);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }

        return true;
    }
}