<?php

namespace App\Livewire;

use Livewire\Component;

class MosqueLandingPage extends Component
{
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
