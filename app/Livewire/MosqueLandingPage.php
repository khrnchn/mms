<?php

namespace App\Livewire;

use Livewire\Component;

class MosqueLandingPage extends Component
{
    public $prayerTimes = [
        'Fajr' => '5:45 AM',
        'Zuhr' => '1:15 PM',
        'Asr' => '4:30 PM',
        'Maghrib' => '7:15 PM',
        'Isha' => '8:45 PM'
    ];

    public $upcomingEvents = [
        [
            'title' => 'Jumaah Prayer',
            'date' => 'Every Friday',
            'time' => '1:15 PM'
        ],
        [
            'title' => 'Quran Class',
            'date' => 'Every Saturday',
            'time' => '10:00 AM'
        ]
    ];

    public function getLayout()
    {
        return 'components.layouts.app';
    }

    public function render()
    {
        return view('livewire.mosque-landing-page');
    }
}
