<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\User;

class MedicalRecordsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Retrieve all valid user IDs
        $userIds = User::pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            DB::table('medical_records')->insert([
                'user_id' => $faker->randomElement($userIds), // Ensures valid foreign key
                'date' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                'condition' => $faker->sentence(3),  // E.g., "Chronic back pain"
                'treatment' => $faker->sentence(4),  // E.g., "Physical therapy sessions"
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
