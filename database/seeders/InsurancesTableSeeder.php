<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\User;

class InsurancesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Fetch all valid user IDs
        $userIds = User::pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            DB::table('insurances')->insert([
                'user_id' => $faker->randomElement($userIds), // Valid user ID
                'provider' => $faker->company,
                'policyNumber' => $faker->unique()->numerify('POL-#######'),
                'coverageType' => $faker->randomElement(['Basic', 'Standard', 'Premium']),
                'validUntil' => $faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
