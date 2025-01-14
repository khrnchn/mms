<?php

namespace App\Filament\Resources\ForumResource\Pages;

use App\Filament\Resources\ForumResource;
use App\Models\Forum;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListForums extends ListRecords
{
    protected static string $resource = ForumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // Admin can see all forums
            return Forum::query();
        }

        // Non-admin users can only see forums where they have created at least one topic
        return Forum::query()->whereHas('topics', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }
}
