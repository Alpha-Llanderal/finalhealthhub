<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneNumberFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'phoneNumber' => sprintf(
                '%03d-%03d-%04d',
                rand(0, 999),
                rand(0, 999),
                rand(0, 9999)
            ),
        ];
    }
}