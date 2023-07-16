<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Api\BaseProduct;
use App\Models\Product;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Repository\ProductUpdateRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ProductUpdateController extends BaseProduct
{
    public function __construct(private readonly ProductUpdateRepository $repository){}

    public function __invoke(ProductUpdateRequest $request, int $id): JsonResponse
    {
        $product = $this->getProduct($id);

        if ($product === null) {
            return response()->json(
                ["message" => "Product not found"],
                Response::HTTP_NOT_FOUND
            );
        }

        $updated = $this->repository->update($product, $request);

        if($updated) {
            return response()->json(
                ["message" => "Product updated"],
                Response::HTTP_OK
            );
        }

        return response()->json(
            ["message" => "Product updated false"],
            Response::HTTP_BAD_REQUEST
        );
    }
}
