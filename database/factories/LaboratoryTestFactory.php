<?php

namespace Database\Factories;

use App\Models\LaboratoryTest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaboratoryTestFactory extends Factory
{
    protected $model = LaboratoryTest::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'dateUploaded' => now(),
            'labTestName' => $this->faker->word(),
            'fileURL' => $this->faker->url(),
        ];
    }
}