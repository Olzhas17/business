<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Cart;

use App\DTOs\CartProductsDto;
use App\Http\Requests\Cart\DeleteCartProduct;
use App\Models\Product;
use App\Repository\BaseCartRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class DeleteCartProductsController extends BaseCartRepository
{
    public function __invoke(DeleteCartProduct $request): JsonResponse
    {
        $products = $request->get('products');
        $cart = $request->user()->cart;
        $cart->products()->detach($products);

        $cartProductDto = CartProductsDto::toArray($cart->products);
        $this->recalculateCart($cart, $cartProductDto);

        return response()->json(
            ['message' => 'Success'],
            Response::HTTP_OK
        );
    }
}
