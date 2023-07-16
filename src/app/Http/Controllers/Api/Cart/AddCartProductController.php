<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Cart;

use App\DTOs\RequestToCartProductDto;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Repository\CreateCartProductRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Cart\CartProductRequest;

final class AddCartProductController
{
    public function __construct(private CreateCartProductRepository $repository){}
    public function __invoke(CartProductRequest $request): JsonResponse
    {
        $cart = $request->user()->getUserCart();
        $products = RequestToCartProductDto::toArray($request->get('products', []));

        if ($this->repository->create($cart, $products)) {
            return response()->json(
                ["message" => "Success"],
                Response::HTTP_OK
            );
        }

        return response()->json(
            ["message" => "Error creating"],
            Response::HTTP_BAD_REQUEST
        );
    }
}
