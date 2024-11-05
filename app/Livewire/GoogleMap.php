<?php

namespace App\Livewire;

use Livewire\Component;

class GoogleMap extends Component
{
    public $apiKey;
    public $address;

    public function mount()
    {
        $this->apiKey = env('GOOGLE_MAPS_API_KEY');
        $this->address = 'Masjid Bandar Tun Hussein Onn'; 
    }

    public function render()
    {
        return view('livewire.google-map');
    }
}
