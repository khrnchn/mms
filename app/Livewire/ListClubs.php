<?php

namespace App\Livewire;

use App\Models\Club;
use App\Models\ClubUser;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ListClubs extends Component
{
    public $clubs;
    public $selectedClub = null;

    public function mount()
    {
        $this->clubs = Club::where('is_active', true)
            ->withCount('users')
            ->get();
    }

    public function joinClub($clubId)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            $this->dispatch('open-login-modal');
            return;
        }

        $user = Auth::user();

        // Check if user is already a member
        $existingMembership = ClubUser::where('club_id', $clubId)
            ->where('user_id', $user->id)
            ->exists();

        if ($existingMembership) {
            session()->flash('error', 'You are already a member of this club.');
            return;
        }

        // Add user to the club
        ClubUser::create([
            'club_id' => $clubId,
            'user_id' => $user->id,
            'role' => 'member',
            'joined_at' => now()
        ]);

        session()->flash('success', 'Successfully joined the club!');

        // Refresh the clubs list
        $this->mount();
    }

    public function render()
    {
        return view('livewire.list-clubs');
    }
}
