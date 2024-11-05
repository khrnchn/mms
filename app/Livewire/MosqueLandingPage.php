<?php

namespace App\Livewire;

use Livewire\Component;

class MosqueLandingPage extends Component
{

    public function getLayout()
    {
        return 'components.layouts.app';
    }

    public function render()
    {
        return view('livewire.mosque-landing-page');
    }
}
