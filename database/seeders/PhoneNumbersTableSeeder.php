<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\User;

class PhoneNumbersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get an array of all existing user IDs
        $userIds = User::pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            DB::table('phone_numbers')->insert([
                'user_id' => $faker->randomElement($userIds), // Ensures foreign key consistency
                'phoneNumber' => $faker->phoneNumber,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
