<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use App\Models\Event;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

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
            return Event::query();
        }

        // Regular users can only view events they have joined
        return Event::query()->whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }
}
