<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\User;

class AddressesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Get all existing user IDs
        $userIds = User::pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            DB::table('addresses')->insert([
                'user_id' => $faker->randomElement($userIds), // Pick a random existing user ID
                'address' => $faker->address,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
