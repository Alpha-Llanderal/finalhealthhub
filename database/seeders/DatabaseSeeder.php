<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    /*public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
             @return void
        */

   

        public function run()
{
    $this->call(UsersTableSeeder::class);
    $this->call(AddressesTableSeeder::class);
    $this->call(PhoneNumbersTableSeeder::class);
    $this->call(InsurancesTableSeeder::class);
    $this->call(AppointmentsTableSeeder::class);
    $this->call(MedicalRecordsTableSeeder::class);
    $this->call(LaboratoryTestsTableSeeder::class);
}
    }



