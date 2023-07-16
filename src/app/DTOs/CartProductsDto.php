<?php

declare(strict_types=1);

namespace App\DTOs;

final class CartProductsDto
{
    public static function toArray($products): array
    {
        $result = [];
        foreach($products as $product) {
            $result[$product->pivot->product_id] = [
                'quantity' => $product->pivot->quantity
            ];
        }

        return $result;
    }
}
