<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventRegistrationResource\RelationManagers\RegistrationsRelationManager;
use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Manage';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Event Details')
                    ->schema([
                        TextInput::make('name')
                            ->placeholder('Enter event name')
                            ->label('Event Name')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->placeholder('Enter event description')
                            ->label('Event Description')
                            ->required(),
                        DateTimePicker::make('start_date')
                            ->placeholder('Enter event start date and time')
                            ->label('Start Date')
                            ->native(false)
                            ->before('end_date')
                            ->required(),
                        DateTimePicker::make('end_date')
                            ->placeholder('Enter event end date and time')
                            ->label('End Date')
                            ->native(false)
                            ->after('start_date')
                            ->required(),
                        TextInput::make('location')
                            ->placeholder('Enter event location')
                            ->label('Event Location')
                            ->required()
                            ->maxLength(255),
                        Select::make('organizer_id')
                            ->placeholder('Choose an organizer')
                            ->label('Organizer')
                            ->relationship('organizer', 'name')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    // ->description(fn(Event $record): string => $record->description)
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('location')
                    ->label('Location')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->sortable()
                    ->formatStateUsing(fn($record) => Carbon::parse($record->start_date)->format('d F Y h:i A')),
                TextColumn::make('end_date')
                    ->label('End Date')
                    ->sortable()
                    ->formatStateUsing(fn($record) => Carbon::parse($record->end_date)->format('d F Y h:i A')),
                // TextColumn::make('organizer.name')
                //     ->label('Created By')
                //     ->sortable(),
            ])
            ->filters([
                Filter::make('start_date')
                    ->form([
                        DatePicker::make('start_date')
                            ->placeholder('Enter event start date and time')
                            ->native(false)
                            ->label('Start Date'),
                        DatePicker::make('end_date')
                            ->placeholder('Enter event end date and time')
                            ->native(false)
                            ->label('End Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_date'],
                                fn(Builder $query, $date) => $query->whereDate('start_date', '>=', $date)
                            )
                            ->when(
                                $data['end_date'],
                                fn(Builder $query, $date) => $query->whereDate('end_date', '<=', $date)
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RegistrationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
