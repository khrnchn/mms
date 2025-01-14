<?php

namespace App\Filament\Resources\ClubResource\Pages;

use App\Filament\Resources\ClubResource;
use App\Models\Club;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListClubs extends ListRecords
{
    protected static string $resource = ClubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $user = auth()->user();

        // Admins can view all clubs
        if ($user->isAdmin()) {
            return Club::query();
        }

        // Regular users can only view clubs they have joined
        return Club::query()->whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }
}
