<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Product;

use App\Http\Resources\ProductsResource;
use App\Repository\GetActiveProductsRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ProductsGetController
{
    public function __construct(private readonly GetActiveProductsRepository $repository){}

    public function __invoke(): AnonymousResourceCollection
    {
        $products = $this->repository->get();

        return ProductsResource::collection($products);
    }
}
