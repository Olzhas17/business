<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Api\BaseProduct;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductDetailsController extends BaseProduct
{
    public function __invoke(int $id): JsonResponse|ProductResource
    {
        $product = $this->getProduct($id);

        if ($product === null) {
            return response()->json(
                ["message" => "Product not found"],
                Response::HTTP_NOT_FOUND
            );
        }

        return ProductResource::make($product);
    }
}
