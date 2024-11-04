<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PrayerTimes extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            // Stat::make('Fajr', '05:49 AM'),
            // Stat::make('Dhuhr', '01:10 PM'),
            // Stat::make('Asr', '04:15 PM'),
            // Stat::make('Maghrib', '06:59 PM'),
            // Stat::make('Isha', '08:12 PM'),
        ];
    }

    protected function getColumns(): int
    {
        return 5;
    }
}
