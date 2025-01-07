<?php

namespace Database\Seeders;

use App\Models\Club; // Import the Club model
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the data to be inserted
        $clubs = [
            [
                'name' => 'Kelab Remaja Masjid',
                'description' => 'Kelab untuk remaja yang aktif dalam aktiviti keagamaan dan kemasyarakatan.',
                'location' => 'Dewan Serbaguna Masjid',
                'established_date' => '2020-01-15',
                'contact_email' => 'admin@admin.com',
                'contact_phone' => '03-1234 5678',
                'is_active' => true,
            ],
            [
                'name' => 'Kelab Seni Khat',
                'description' => 'Kelab yang mengajar seni khat dan kaligrafi Islam.',
                'location' => 'Ruang Seni Masjid',
                'established_date' => '2019-05-20',
                'contact_email' => 'admin@admin.com',
                'contact_phone' => '03-1234 5678',
                'is_active' => true,
            ],
            [
                'name' => 'Kelab Bahasa Arab',
                'description' => 'Kelab yang menyediakan kelas pembelajaran bahasa Arab untuk semua peringkat umur.',
                'location' => 'Ruang Kelas Masjid',
                'established_date' => '2018-08-10',
                'contact_email' => 'admin@admin.com',
                'contact_phone' => '03-1234 5678',
                'is_active' => true,
            ],
            [
                'name' => 'Kelab Sukan dan Rekreasi',
                'description' => 'Kelab yang menganjurkan aktiviti sukan dan rekreasi untuk masyarakat setempat.',
                'location' => 'Gelanggang Sukan Masjid',
                'established_date' => '2021-03-25',
                'contact_email' => 'admin@admin.com',
                'contact_phone' => '03-1234 5678',
                'is_active' => true,
            ],
            [
                'name' => 'Kelab Kebajikan dan Amal',
                'description' => 'Kelab yang menguruskan aktiviti kebajikan dan amal untuk membantu golongan yang memerlukan.',
                'location' => 'Pejabat Kebajikan Masjid',
                'established_date' => '2017-11-30',
                'contact_email' => 'admin@admin.com',
                'contact_phone' => '03-1234 5678',
                'is_active' => true,
            ],
        ];

        // Insert the data into the database
        foreach ($clubs as $club) {
            Club::create($club);
        }
    }
}
