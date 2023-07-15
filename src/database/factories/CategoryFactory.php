<?php

namespace Database\Factories;

use App\Enums\CategoryStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'status' => fake()->randomElement(CategoryStatusEnum::class)
        ];
    }
}
