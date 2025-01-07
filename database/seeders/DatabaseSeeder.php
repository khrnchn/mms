<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'is_admin'=> true,
        ]);

        $this->call([
            ClubSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CommitteeSeeder::class,
            EventSeeder::class,
            NewsSeeder::class,
        ]);
    }
}
