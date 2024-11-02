<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'date' => now()->addDays(rand(1, 30)),
            'doctor' => $this->faker->name('male') . ', MD',
            'reason' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['scheduled', 'completed', 'cancelled']),
            'outcome' => null,
        ];
    }
}