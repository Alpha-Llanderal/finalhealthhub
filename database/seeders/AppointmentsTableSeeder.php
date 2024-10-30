<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\User;

class AppointmentsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get an array of all valid user IDs
        $userIds = User::pluck('id')->toArray();

        foreach (range(1, 50) as $index) {
            DB::table('appointments')->insert([
                'user_id' => $faker->randomElement($userIds), // Ensures valid foreign key
                'date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
                'doctor' => $faker->name,
                'reason' => $faker->sentence(3),
                'status' => $faker->randomElement(['scheduled', 'completed', 'canceled']),
                'outcome' => $faker->optional()->sentence(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
