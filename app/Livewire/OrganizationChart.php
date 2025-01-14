<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Role;

class OrganizationChart extends Component
{
    public $roles;

    public function mount()
    {
        // Fetch all roles with their associated committees and users
        $this->roles = Role::with('committees.user')->get();
    }

    public function render()
    {
        return view('livewire.organization-chart');
    }
}