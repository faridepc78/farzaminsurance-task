<?php

namespace Database\Factories;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 12345678,
            'role' => UserRoleEnum::USER->value
        ];
    }
}
