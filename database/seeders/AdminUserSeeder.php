<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@hostel.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '0700000000',
            'email_verified_at' => now(),
        ]);
        
        User::create([
            'name' => 'John Student',
            'email' => 'student@hostel.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'phone' => '0711111111',
            'student_id' => 'ST-001',
            'gender' => 'male',
            'course' => 'Computer Science',
            'year_of_study' => 1,
            'email_verified_at' => now(),
        ]);
    }
}
