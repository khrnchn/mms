<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class Navigation extends Component
{
    // Menu items can be managed here and easily updated
    public $menuItems = [
        ['label' => 'Home', 'route' => '/', 'active' => false],
        ['label' => 'Prayer Times', 'route' => '#prayer-times', 'active' => false],
        ['label' => 'News', 'route' => '#news-preview', 'active' => false],
        ['label' => 'Events', 'route' => '#events', 'active' => false],
        ['label' => 'Clubs', 'route' => '#clubs', 'active' => false],
        ['label' => 'Contact', 'route' => '#contact', 'active' => false],
        ['label' => 'Forum', 'route' => '/forums', 'active' => false],
    ];

    public function render()
    {
        // Dynamically set the active state based on the current route
        foreach ($this->menuItems as $key => $item) {
            $this->menuItems[$key]['active'] = $this->isActive($item['route']);
        }

        return view('livewire.navigation');
    }

    /**
     * Check if a given route is active.
     *
     * @param string $route
     * @return bool
     */
    protected function isActive($route)
    {
        if ($route === '/') {
            return request()->is('/');
        }

        return request()->is(ltrim($route, '/'));
    }
}
