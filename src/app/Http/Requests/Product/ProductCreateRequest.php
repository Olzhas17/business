<?php

namespace App\Http\Requests\Product;

use App\Enums\ProductInStockEnum;
use App\Enums\ProductStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class ProductCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'price' => 'required|numeric|between:0,99.99',
            'description' => 'string',
            'in_stock' => [new Enum(ProductInStockEnum::class)],
            'is_active' => [new Enum(ProductStatusEnum::class)],
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
