<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClubResource\Pages;
use App\Filament\Resources\ClubResource\RelationManagers\ClubUsersRelationManager;
use App\Models\Club;
use App\Models\ClubUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ClubResource extends Resource
{
    protected static ?string $model = Club::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Manage';

    public static function canCreate(): bool
    {
        $user = Auth::user();

        return $user->isAdmin();
    }

    public static function getNavigationBadge(): ?string
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return static::getModel()::count();
        }

        return $user->clubs()->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Club Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Club Name'),

                        Forms\Components\Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\DatePicker::make('established_date')
                            ->label('Establishment Date'),

                        // Add the participants_limit field
                        Forms\Components\TextInput::make('participants_limit')
                            ->numeric()
                            ->minValue(0)
                            ->nullable()
                            ->label('Participants Limit'),
                    ])->columns(2),

                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('contact_email')
                            ->email()
                            ->label('Contact Email'),

                        Forms\Components\TextInput::make('contact_phone')
                            ->tel()
                            ->label('Contact Phone'),
                    ])->columns(2),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Status')
                            ->default(true),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('established_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                Tables\Columns\TextColumn::make('participants_limit')
                    ->label('Participants Limit')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state ?? 'No limit'),

                Tables\Columns\TextColumn::make('users_count')
                    ->counts('users')
                    ->label('Member Count'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),

                Tables\Filters\Filter::make('active')
                    ->query(fn(Builder $query): Builder => $query->where('is_active', true))
                    ->label('Active Clubs'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->hidden(fn() => !Auth::user()->isAdmin()),
                Tables\Actions\EditAction::make()->hidden(fn() => !Auth::user()->isAdmin()),
                Tables\Actions\DeleteAction::make()->hidden(fn() => !Auth::user()->isAdmin()),
                Action::make('register')
                    ->requiresConfirmation()
                    ->modalHeading('Register for Club')
                    ->modalDescription('Are you sure you want to register for this club?')
                    ->modalSubmitActionLabel('Yes, register')
                    ->modalCancelActionLabel('Cancel')
                    ->hidden(function (Club $club) {
                        $user = Auth::user();

                        return ClubUser::where('club_id', $club->id)
                            ->where('user_id', $user->id)
                            ->exists();
                    })
                    ->action(
                        function (Club $club) {
                            $user = Auth::user();

                            $existingRegistration = ClubUser::where('club_id', $club->id)
                                ->where('user_id', $user->id)
                                ->exists();

                            if ($existingRegistration) {
                                Notification::make()
                                    ->title('Registration failed.')
                                    ->body('You have already registered for this club.')
                                    ->danger()
                                    ->send();

                                return;
                            }

                            if ($club->participants_limit !== null) {
                                $currentMembersCount = ClubUser::where('club_id', $club->id)->count();

                                if ($currentMembersCount >= $club->participants_limit) {
                                    Notification::make()
                                        ->title('Registration failed.')
                                        ->body('This club has reached its maximum number of members.')
                                        ->danger()
                                        ->send();

                                    return;
                                }
                            }

                            if ($club->participants_limit !== null) {
                                $currentMembersCount = ClubUser::where('club_id', $club->id)->count();

                                if ($currentMembersCount >= $club->participants_limit) {
                                    Notification::make()
                                        ->title('Registration failed.')
                                        ->body('This club has reached its maximum number of members.')
                                        ->danger()
                                        ->send();

                                    return;
                                }
                            }

                            ClubUser::create([
                                'club_id' => $club->id,
                                'user_id' => $user->id,
                                'role' => 'member',
                                'joined_at' => now(),
                            ]);

                            Notification::make()
                                ->title('Registration success.')
                                ->body('You have successfully registered for this club.')
                                ->success()
                                ->send();
                        }
                    )
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn() => !Auth::user()->isAdmin()),
                    Tables\Actions\ForceDeleteBulkAction::make()->hidden(fn() => !Auth::user()->isAdmin()),
                    Tables\Actions\RestoreBulkAction::make()->hidden(fn() => !Auth::user()->isAdmin()),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ClubUsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClubs::route('/'),
            'create' => Pages\CreateClub::route('/create'),
            'edit' => Pages\EditClub::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
