<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;
    public function definition()
    {
        return [
            'firstName' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password123'),
            'birthDate' => $this->faker->date(),
            'profilePicture' => $this->faker->imageUrl(),
            'isSelfPay' => $this->faker->boolean(),
        ];
    }
    
}