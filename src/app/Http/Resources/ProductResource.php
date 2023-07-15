<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'inStock' => $this->in_stock,
            'isActive' => $this->is_active,
            'images' => ImagesResource::collection($this->images),
            'createdAt' => $this->created_at,
        ];
    }
}
