<?php

namespace Database\Seeders;

use App\Models\Role; // Import the Role model
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the data to be inserted
        $roles = [
            [
                'name' => 'Imam',
                'description' => 'Pemimpin solat dan aktiviti keagamaan di masjid.',
            ],
            [
                'name' => 'Bilal',
                'description' => 'Bertanggungjawab melaungkan azan dan membantu imam dalam solat.',
            ],
            [
                'name' => 'Siak',
                'description' => 'Bertugas menjaga kebersihan dan keperluan masjid.',
            ],
            [
                'name' => 'AJK Kebajikan',
                'description' => 'Ahli Jawatankuasa yang menguruskan aktiviti kebajikan masjid.',
            ],
            [
                'name' => 'AJK Pendidikan',
                'description' => 'Ahli Jawatankuasa yang menguruskan program pendidikan dan kelas agama.',
            ],
            [
                'name' => 'Bendahari',
                'description' => 'Menguruskan kewangan dan dana masjid.',
            ],
            [
                'name' => 'AJK Teknikal',
                'description' => 'Ahli Jawatankuasa yang menguruskan penyelenggaraan fasiliti masjid.',
            ],
        ];

        // Insert the data into the database
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
