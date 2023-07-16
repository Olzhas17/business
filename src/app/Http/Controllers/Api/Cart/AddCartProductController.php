<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Cart;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Repository\CreateCartProductRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Cart\CartProductRequest;

class AddCartProductController
{
    public function __construct(private CreateCartProductRepository $repository){}
    public function __invoke(CartProductRequest $request): JsonResponse
    {
        $cart = $request->user()->getUserCart();

        if ($this->repository->create($cart, $request->get('products', []))) {
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
