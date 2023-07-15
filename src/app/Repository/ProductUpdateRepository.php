<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductUpdateRepository
{
    public function update(Product $product, Request $request): bool
    {
        if ($request->hasFile('images')) {
            $images = $request->images;
            $this->updateImage($product, $images);
        }

        return $product->update($request->except('images'));
    }

    private function updateImage($product, array $images): void
    {
        try {
            foreach ($product->images as $image) {
                if (Storage::exists($image->path)) {
                    Storage::delete($image->path);
                }
            }

            foreach ($images as $image) {
                $path = Storage::putFile('public/product/images', $image);
                Image::create([
                    'path' => $path,
                    'product_id' => $product->id
                ]);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}