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
            'name' => 'Ankit Razzput',
            'email' => 'Razzup@example.com',
            'mobile' => '9876543210',
            'dob' => '2004-11-22',
            'address' => 'dehri, bihar',
            'password' => Hash::make('password123'),
        ]);

        // Create additional test users
        User::create([
            'name' => 'Mangal Kumar',
            'email' => 'mangal@example.com',
            'mobile' => '9876543211',
            'dob' => '2004-10-19',
            'address' => 'sasaram, bihar',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Raushan Dubey',
            'email' => 'raushan@example.com',
            'mobile' => '9876543212',
            'dob' => '2005-01-09',
            'address' => 'dehri, bihar',
            'password' => Hash::make('password123'),
        ]);
    }
}
