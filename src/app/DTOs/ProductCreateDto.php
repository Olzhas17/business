<?php

namespace App\DTOs;

use App\Enums\ProductInStockEnum;
use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\Enum;
use WendellAdriel\ValidatedDTO\Casting\FloatCast;
use WendellAdriel\ValidatedDTO\Casting\IntegerCast;
use WendellAdriel\ValidatedDTO\Casting\StringCast;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ProductCreateDto extends ValidatedDTO
{
    public string $name;
    public float $price;
    public string $description;
    public string $inStock;
    public string $isActive;
    public UploadedFile $images;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric', 'between:0,99.99'],
            'description' => ['string'],
            'inStock' => ['required', 'string'],
            'isActive' => ['required', 'string'],
            'images' => ['mimes:jpg,jpeg', 'max:2048'],
        ];
    }

    protected function casts(): array
    {
        return [
            'name' => new StringCast(),
            'description' => new StringCast(),
            'price' => new FloatCast(),
            'inStock' => new StringCast(),
            'isActive' => new StringCast(),
        ];
    }

    protected function defaults(): array
    {
        return [];
    }
}
