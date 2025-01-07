<?php

namespace Database\Seeders;

use App\Models\Committee; // Import the Committee model
use App\Models\User; // Import the User model
use App\Models\Role; // Import the Role model
use Illuminate\Database\Seeder;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users and roles
        $users = User::all();
        $roles = Role::all();

        // Assign roles to users
        $committees = [
            [
                'user_id' => $users[0]->id, // Ahmad bin Ismail
                'role_id' => $roles->where('name', 'Imam')->first()->id, // Imam
            ],
            [
                'user_id' => $users[1]->id, // Siti binti Mohd
                'role_id' => $roles->where('name', 'Bilal')->first()->id, // Bilal
            ],
            [
                'user_id' => $users[2]->id, // Mohd Ali bin Hassan
                'role_id' => $roles->where('name', 'Siak')->first()->id, // Siak
            ],
            [
                'user_id' => $users[3]->id, // Fatimah binti Abdullah
                'role_id' => $roles->where('name', 'AJK Kebajikan')->first()->id, // AJK Kebajikan
            ],
            [
                'user_id' => $users[4]->id, // Ismail bin Yusof
                'role_id' => $roles->where('name', 'Bendahari')->first()->id, // Bendahari
            ],
        ];

        // Insert the data into the database
        foreach ($committees as $committee) {
            Committee::create($committee);
        }
    }
}
