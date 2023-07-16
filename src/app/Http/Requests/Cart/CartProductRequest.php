<?php

namespace App\Http\Requests\Cart;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CartProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            "products" => [
                'required',
                'min:1',
                function ($attribute, $value, $fail) {
                    foreach($value as $val) {
                        $product = Product::where('id', $val['product_id'])->first();
                        if ($product === null) {
                            $fail('The product by id '. $val['product_id'] .' not found');
                        }
                    }
                }
            ],
        ];
    }
}
