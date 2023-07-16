<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Product;

use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Image;
use App\Repository\ProductCreateRepository;
use Illuminate\Support\Facades\Storage;

final class ProductCreateController
{
    public function __construct(private readonly ProductCreateRepository $repository){}

    public function __invoke(ProductCreateRequest $request): ProductResource
    {
        $product = $this->repository->create($request);

        if ($request->hasFile('images')) {
            $images = $request->images;

            foreach($images as $image) {
                $path = Storage::putFile('public/product/images', $image);
                Image::create([
                    'path' => $path,
                    'product_id' => $product->id
                ]);
            }
        }

        return ProductResource::make($product);
    }
}