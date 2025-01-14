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
        ['label' => 'Donation', 'route' => '/donation', 'active' => false],
        ['label' => 'Organization Chart', 'route' => '/organization-chart', 'active' => false],
    ];

    public function render()
    {
        // Filter menu items based on the current route
        $filteredMenuItems = $this->filterMenuItems();

        // Dynamically set the active state based on the current route
        foreach ($filteredMenuItems as $key => $item) {
            $filteredMenuItems[$key]['active'] = $this->isActive($item['route']);
        }

        return view('livewire.navigation', [
            'filteredMenuItems' => $filteredMenuItems,
        ]);
    }

    /**
     * Filter menu items based on the current route.
     *
     * @return array
     */
    protected function filterMenuItems()
    {
        $currentRoute = request()->route()->getName();

        // If on the home route, show all menu items
        if (request()->is('/')) {
            return $this->menuItems;
        }

        // If on the forum or donation route, show only Home, Forum, and Donation
        if (request()->is('forums*') || request()->is('donation*')  || request()->is('organization-chart*')) {
            return array_filter($this->menuItems, function ($item) {
                return in_array($item['route'], ['/', '/forums', '/donation', '/organization-chart']);
            });
        }

        // Default: show all menu items
        return $this->menuItems;
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