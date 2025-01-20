<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DonationStats extends BaseWidget
{
    protected function getCards(): array
    {
        // Calculate totals for each category
        $totalSedekah = Transaction::where('donation_type', 'sedekah')->sum('amount');
        $totalInfaq = Transaction::where('donation_type', 'infaq')->sum('amount');
        $totalRamadhan = Transaction::where('donation_type', 'ramadhan')->sum('amount');

        // Calculate the overall total
        $totalDonations = Transaction::sum('amount');

        return [
            // Stat for Sedekah
            Stat::make('Total Sedekah', 'RM ' . number_format($totalSedekah, 2))
                ->description('Total donations for Sedekah')
                ->color('success'), // Green color

            // Stat for Infaq
            Stat::make('Total Infaq', 'RM ' . number_format($totalInfaq, 2))
                ->description('Total donations for Infaq')
                ->color('danger'), // Blue color

            // Stat for Ramadhan
            Stat::make('Total Ramadhan', 'RM ' . number_format($totalRamadhan, 2))
                ->description('Total donations for Ramadhan')
                ->color('warning'), // Yellow color

            // Stat for Overall Total
            Stat::make('Total Donations', 'RM ' . number_format($totalDonations, 2))
                ->description('Total of all donations')
                ->color('gray'), // Gray color
        ];
    }
}
