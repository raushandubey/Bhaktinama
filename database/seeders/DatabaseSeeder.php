<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'mobile' => '9876543210',
            'dob' => '1990-01-01',
            'address' => '123 Test Street, Test City',
            'password' => Hash::make('password123'),
        ]);

        // Create additional test users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'mobile' => '9876543211',
            'dob' => '1985-05-15',
            'address' => '456 Main Street, City Center',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'mobile' => '9876543212',
            'dob' => '1992-08-20',
            'address' => '789 Oak Avenue, Suburb',
            'password' => Hash::make('password123'),
        ]);
    }
}
