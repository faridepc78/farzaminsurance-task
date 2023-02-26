<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'slug' => fake()->unique()->slug(),
            'code' => make_token(10),
            'price' => fake()->numberBetween(1000, 1000000),
            'discount' => fake()->numberBetween(1, 100),
            'description' => fake()->text(1000)
        ];
    }
}
