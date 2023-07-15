<?php

namespace Database\Factories;

use App\Enums\ProductInStockEnum;
use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->randomFloat(8, 2, 100),
            'description' => fake()->paragraph,
            'in_stock' => fake()->randomElement(ProductInStockEnum::class),
            'is_active' => fake()->randomElement(ProductStatusEnum::class)
        ];
    }
}
