<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create sample users
        User::create([
            'firstName' => 'Alpha',
            'lastName' => 'Work',
            'email' => 'alpha@example.com',
            'password' => Hash::make('password123'),
            'birthDate' => '1984-10-15',
            'profilePicture' => null,
            'isSelfPay' => false,
        ]);

        // Add more users if needed
    }
}
