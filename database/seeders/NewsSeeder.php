<?php

namespace Database\Seeders;

use App\Models\News; // Import the News model
use App\Models\User; // Import the User model
use Carbon\Carbon; // For date formatting
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // For generating slugs

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the author (user) IDs
        $authors = User::pluck('id')->toArray();

        // Define the data to be inserted
        $news = [
            [
                'title' => 'Majlis Khatam Al-Quran Berjaya Dilaksanakan',
                'slug' => Str::slug('Majlis Khatam Al-Quran Berjaya Dilaksanakan'),
                'content' => 'Majlis khatam Al-Quran bulanan telah berjaya dilaksanakan pada 15 November 2023. Majlis ini dihadiri oleh lebih 100 orang jemaah.',
                'image' => null, // Leave empty
                'author_id' => $authors[0], // Assign to the first user
                'status' => 'published',
                'featured' => true,
                'published_at' => Carbon::create(2023, 11, 16, 10, 0, 0),
            ],
            [
                'title' => 'Kelas Fardhu Ain Untuk Kanak-Kanak',
                'slug' => Str::slug('Kelas Fardhu Ain Untuk Kanak-Kanak'),
                'content' => 'Kelas fardhu ain untuk kanak-kanak telah bermula pada 20 November 2023. Kelas ini diadakan setiap minggu di ruang kelas masjid.',
                'image' => null, // Leave empty
                'author_id' => $authors[0], // Assign to the first user
                'status' => 'published',
                'featured' => false,
                'published_at' => Carbon::create(2023, 11, 21, 9, 0, 0),
            ],
            [
                'title' => 'Gotong-Royong Membersihkan Kawasan Masjid',
                'slug' => Str::slug('Gotong-Royong Membersihkan Kawasan Masjid'),
                'content' => 'Program gotong-royong membersihkan kawasan masjid telah diadakan pada 25 November 2023. Seramai 50 orang telah menyertai program ini.',
                'image' => null, // Leave empty
                'author_id' => $authors[0], // Assign to the first user
                'status' => 'published',
                'featured' => true,
                'published_at' => Carbon::create(2023, 11, 26, 8, 0, 0),
            ],
            [
                'title' => 'Ceramah Agama: Kehidupan Rasulullah SAW',
                'slug' => Str::slug('Ceramah Agama Kehidupan Rasulullah SAW'),
                'content' => 'Ceramah agama mengenai kehidupan dan sunnah Rasulullah SAW telah diadakan pada 1 Disember 2023. Ceramah ini disampaikan oleh Ustaz Ahmad.',
                'image' => null, // Leave empty
                'author_id' => $authors[0], // Assign to the first user
                'status' => 'published',
                'featured' => false,
                'published_at' => Carbon::create(2023, 12, 2, 10, 0, 0),
            ],
            [
                'title' => 'Program Qiamullail Untuk Remaja',
                'slug' => Str::slug('Program Qiamullail Untuk Remaja'),
                'content' => 'Program qiamullail untuk remaja telah diadakan pada 10 Disember 2023. Program ini dihadiri oleh lebih 30 orang remaja.',
                'image' => null, // Leave empty
                'author_id' => $authors[0], // Assign to the first user
                'status' => 'published',
                'featured' => true,
                'published_at' => Carbon::create(2023, 12, 11, 7, 0, 0),
            ],
        ];

        // Insert the data into the database
        foreach ($news as $article) {
            News::create($article);
        }
    }
}
