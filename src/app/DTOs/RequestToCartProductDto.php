<?php

declare(strict_types=1);

namespace App\DTOs;

final class RequestToCartProductDto
{
    public static function toArray($products): array
    {
        $result = [];

        foreach($products as $product) {
            $result[$product['product_id']] = [
                'quantity' => $product['quantity']
            ];
        }

        return $result;
    }
}