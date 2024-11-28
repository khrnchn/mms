<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Validator;

class ViewEvent extends Component
{
    public $event;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $registrationSuccess = false;

    public function mount($eventId)
    {
        $this->event = Event::findOrFail($eventId);
    }

    public function registerForEvent()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        try {
            // Check if registration already exists
            $existingRegistration = EventRegistration::where('event_id', $this->event->id)
                ->where('email', $this->email)
                ->first();

            if ($existingRegistration) {
                session()->flash('error', 'You have already registered for this event.');
                return;
            }

            // Create new registration
            EventRegistration::create([
                'event_id' => $this->event->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'status' => 'pending'
            ]);

            // Reset form and show success message
            $this->registrationSuccess = true;
            $this->reset(['name', 'email', 'phone']);
            session()->flash('success', 'Registration successful! We will contact you soon.');
        } catch (\Exception $e) {
            dd($e);
            session()->flash('error', 'Registration failed. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.view-event');
    }
}