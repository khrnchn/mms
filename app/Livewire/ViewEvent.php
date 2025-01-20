<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;
use App\Models\EventParticipant;
use Illuminate\Support\Facades\Auth;

class ViewEvent extends Component
{
    public $event;
    public $registrationSuccess = false;

    public function mount($eventId)
    {
        $this->event = Event::findOrFail($eventId);
    }

    public function registerForEvent()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            session()->flash('error', 'Please login first.');
            return;
        }

        // Get the authenticated user
        $user = Auth::user();

        try {
            // Check if the user is already registered for the event
            $existingRegistration = EventParticipant::where('event_id', $this->event->id)
                ->where('user_id', $user->id)
                ->first();

            if ($existingRegistration) {
                session()->flash('error', 'You have already registered for this event.');
                return;
            }

            // Check if the event has a participants limit
            if ($this->event->participants_limit !== null) {
                // Get the current number of participants
                $currentParticipantsCount = EventParticipant::where('event_id', $this->event->id)->count();

                // Check if the event has reached its participants limit
                if ($currentParticipantsCount >= $this->event->participants_limit) {
                    session()->flash('error', 'This event has reached its maximum number of participants.');
                    return;
                }
            }

            // Create a new event participant record
            EventParticipant::create([
                'event_id' => $this->event->id,
                'user_id' => $user->id,
                'role' => 'participant', // Default role
                'joined_at' => now(), // Current timestamp
                'status' => 'pending', // Default status
            ]);

            // Set success state and flash message
            $this->registrationSuccess = true;
            session()->flash('success', 'Registration successful! You are now a participant.');
        } catch (\Exception $e) {
            session()->flash('error', 'Registration failed. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.view-event');
    }
}