<?php

namespace Database\Seeders;

use App\Models\User; // Import the User model
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // For hashing passwords
use Carbon\Carbon; // For date formatting

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the data to be inserted
        $users = [
            [
                'name' => 'Ahmad bin Ismail',
                'email' => 'ahmad.ismail@gmail.com',
                'password' => Hash::make('password'), // Hashed password
                'profile_picture' => null, // Leave empty
                'phone' => '012-3456789',
                'address' => 'No. 12, Jalan Merdeka, Kuala Lumpur',
                'date_of_birth' => Carbon::create(1990, 5, 15),
                'is_admin' => false,
            ],
            [
                'name' => 'Siti binti Mohd',
                'email' => 'siti.mohd@gmail.com',
                'password' => Hash::make('password'), // Hashed password
                'profile_picture' => null, // Leave empty
                'phone' => '013-4567890',
                'address' => 'No. 8, Taman Seri Indah, Selangor',
                'date_of_birth' => Carbon::create(1985, 8, 22),
                'is_admin' => false,
            ],
            [
                'name' => 'Mohd Ali bin Hassan',
                'email' => 'mohd.ali@gmail.com',
                'password' => Hash::make('password'), // Hashed password
                'profile_picture' => null, // Leave empty
                'phone' => '011-2345678',
                'address' => 'No. 45, Jalan Bahagia, Penang',
                'date_of_birth' => Carbon::create(1995, 3, 10),
                'is_admin' => false,
            ],
            [
                'name' => 'Fatimah binti Abdullah',
                'email' => 'fatimah.abdullah@gmail.com',
                'password' => Hash::make('password'), // Hashed password
                'profile_picture' => null, // Leave empty
                'phone' => '019-8765432',
                'address' => 'No. 23, Taman Harmoni, Johor',
                'date_of_birth' => Carbon::create(1988, 12, 5),
                'is_admin' => false,
            ],
            [
                'name' => 'Ismail bin Yusof',
                'email' => 'ismail.yusof@gmail.com',
                'password' => Hash::make('password'), // Hashed password
                'profile_picture' => null, // Leave empty
                'phone' => '017-3456789',
                'address' => 'No. 7, Jalan Damai, Perak',
                'date_of_birth' => Carbon::create(1992, 7, 30),
                'is_admin' => false,
            ],
        ];

        // Insert the data into the database
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
