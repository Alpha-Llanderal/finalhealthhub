<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\User;

class LaboratoryTestsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Retrieve all valid user IDs
        $userIds = User::pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            DB::table('laboratory_tests')->insert([
                'user_id' => $faker->randomElement($userIds), // Ensures valid foreign key
                'dateUploaded' => Carbon::now()->subDays($faker->numberBetween(1, 365)),
                'labTestName' => $faker->randomElement(['Complete Blood Count', 'Lipid Panel', 'Liver Function Test', 'Kidney Function Test']),
                'fileURL' => $faker->url,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
