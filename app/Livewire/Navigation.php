<?php

namespace App\Livewire;

use Livewire\Component;

class Navigation extends Component
{
    // Menu items can be managed here and easily updated
    public $menuItems = [
        ['label' => 'Home', 'route' => '/', 'active' => true],
        ['label' => 'Prayer Times', 'route' => '#prayer-times', 'active' => false],
        ['label' => 'Events', 'route' => '#events', 'active' => false],
        ['label' => 'Contact', 'route' => '#contact', 'active' => false],
    ];

    public function setActive($index)
    {
        foreach ($this->menuItems as $key => $item) {
            $this->menuItems[$key]['active'] = ($key === $index);
        }
    }

    public function render()
    {
        return view('livewire.navigation');
    }
}
