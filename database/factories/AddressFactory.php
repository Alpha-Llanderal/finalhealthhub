<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'address' => $this->faker->streetAddress(),
        ];
    }
}