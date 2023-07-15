<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Product;


use App\Http\Controllers\Api\BaseProduct;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProductDeleteController extends BaseProduct
{
    public function __invoke(int $id): JsonResponse
    {
        $product = $this->getProduct($id);

        if ($product === null) {
            return response()->json(
                ["message" => "Product not found"],
                Response::HTTP_NOT_FOUND
            );
        }

        $this->deleteImages($product->images);
        $product->delete();

        return response()->json(
            ["message" => "Product deleted"],
            Response::HTTP_NO_CONTENT
        );
    }

    private function deleteImages(array $images): void
    {
        foreach ($images as $image) {
            if (Storage::exists($image->path)) {
                Storage::delete($image->path);
            }
        }
    }
}
