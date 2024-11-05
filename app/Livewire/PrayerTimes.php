<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class PrayerTimes extends Component
{
    public $prayerTimes;
    public $currentPrayer;
    public $nextPrayer;
    public $currentTime;

    public function mount()
    {
        $this->fetchPrayerTimes();
        $this->updatePrayerInfo();
        $this->currentTime = now()->format('h:i:s A');
    }

    public function fetchPrayerTimes()
    {
        // Replace with actual fetching logic if using API or database
        $this->prayerTimes = [
            'Fajr' => '05:30 AM',
            'Dhuhr' => '12:15 PM',
            'Asr' => '03:30 PM',
            'Maghrib' => '06:00 PM',
            'Isha' => '08:00 PM',
        ];
    }

    public function updatePrayerInfo()
    {
        $now = Carbon::now();
        $currentPrayer = null;
        $nextPrayer = null;

        foreach ($this->prayerTimes as $prayer => $time) {
            $prayerTime = Carbon::parse($time);

            if ($now->between($prayerTime, $prayerTime->copy()->addHour())) {
                $currentPrayer = $prayer;
            } elseif ($now->lessThan($prayerTime) && !$nextPrayer) {
                $nextPrayer = $prayer;
            }
        }

        $this->currentPrayer = $currentPrayer ?? 'Isha';
        $this->nextPrayer = $nextPrayer ?? 'Fajr';
    }

    public function render()
    {
        $this->currentTime = now()->format('h:i:s A'); // Update current time for each render
        $this->updatePrayerInfo();
        return view('livewire.prayer-times');
    }
}