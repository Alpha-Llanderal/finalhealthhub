<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InsuranceFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'provider' => $this->faker->company,
            'policyNumber' => $this->faker->unique()->numberBetween(1000000, 9999999),
            'coverageType' => $this->faker->randomElement(['Health', 'Life', 'Dental', 'Vision']),
            'validUntil' => $this->faker->dateTimeBetween('+1 year', '+5 years'),
        ];
    }
}
