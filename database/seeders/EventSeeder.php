<?php

namespace Database\Seeders;

use App\Models\Event; // Import the Event model
use App\Models\User; // Import the User model
use Carbon\Carbon; // For date formatting
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the organizer (user) IDs
        $organizers = User::pluck('id')->toArray();

        // Define the data to be inserted
        $events = [
            [
                'name' => 'Majlis Khatam Al-Quran',
                'description' => 'Majlis khatam Al-Quran bulanan untuk masyarakat setempat.',
                'start_date' => Carbon::create(2023, 11, 15, 9, 0, 0),
                'end_date' => Carbon::create(2023, 11, 15, 12, 0, 0),
                'location' => 'Dewan Serbaguna Masjid',
                'organizer_id' => $organizers[0], // Assign to the first user
            ],
            [
                'name' => 'Kelas Fardhu Ain',
                'description' => 'Kelas pengajian fardhu ain untuk kanak-kanak dan remaja.',
                'start_date' => Carbon::create(2023, 11, 20, 14, 0, 0),
                'end_date' => Carbon::create(2023, 11, 20, 16, 0, 0),
                'location' => 'Ruang Kelas Masjid',
                'organizer_id' => $organizers[0], // Assign to the first user
            ],
            [
                'name' => 'Program Gotong-Royong Masjid',
                'description' => 'Aktiviti gotong-royong membersihkan kawasan masjid.',
                'start_date' => Carbon::create(2023, 11, 25, 8, 0, 0),
                'end_date' => Carbon::create(2023, 11, 25, 12, 0, 0),
                'location' => 'Kawasan Masjid',
                'organizer_id' => $organizers[0], // Assign to the first user
            ],
            [
                'name' => 'Ceramah Agama: Kehidupan Rasulullah SAW',
                'description' => 'Ceramah agama mengenai kehidupan dan sunnah Rasulullah SAW.',
                'start_date' => Carbon::create(2023, 12, 1, 20, 0, 0),
                'end_date' => Carbon::create(2023, 12, 1, 22, 0, 0),
                'location' => 'Dewan Solat Utama Masjid',
                'organizer_id' => $organizers[0], // Assign to the first user
            ],
            [
                'name' => 'Program Qiamullail',
                'description' => 'Program qiamullail untuk remaja dan dewasa.',
                'start_date' => Carbon::create(2023, 12, 10, 3, 0, 0),
                'end_date' => Carbon::create(2023, 12, 10, 6, 0, 0),
                'location' => 'Dewan Solat Utama Masjid',
                'organizer_id' => $organizers[0], // Assign to the first user
            ],
        ];

        // Insert the data into the database
        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
