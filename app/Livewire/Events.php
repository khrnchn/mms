<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class Events extends Component
{
    public $upcomingEvents = [];

    public function mount()
    {
        $this->fetchUpcomingEvents();
    }

    public function fetchUpcomingEvents()
    {
        $this->upcomingEvents = Event::where('start_date', '>=', now()) 
            ->orderBy('start_date')
            ->get(); 
    }

    public function render()
    {
        return view('livewire.events', [
            'upcomingEvents' => $this->upcomingEvents,
        ]);
    }
}
