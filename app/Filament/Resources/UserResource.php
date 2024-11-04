<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Manage';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Details')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter name'),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter email'),
                        TextInput::make('password')
                            ->password()
                            ->placeholder('Enter password')
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create'),
                        FileUpload::make('profile_picture')
                            ->label('Profile Picture')
                            ->image()
                            ->disk('public')
                            ->directory('profile-pictures')
                            ->nullable()
                            ->placeholder('Upload profile picture'),
                        TextInput::make('phone')
                            ->label('Phone')
                            ->tel()
                            ->nullable()
                            ->maxLength(20)
                            ->placeholder('Enter phone number'),
                        Textarea::make('address')
                            ->label('Address')
                            ->nullable()
                            ->maxLength(500)
                            ->placeholder('Enter address'),
                        DatePicker::make('date_of_birth')
                            ->label('Date of Birth')
                            ->nullable()
                            ->native(false)
                            ->placeholder('Select date of birth'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                // ImageColumn::make('profile_picture')
                //     ->label('Profile Picture'),
                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('address')
                    ->label('Address')
                    ->limit(30)
                    ->searchable()
                    ->sortable(),
                // TextColumn::make('date_of_birth')
                //     ->label('Date of Birth')
                //     ->formatStateUsing(fn($state) => Carbon::parse($state)->format('d F Y'))
                //     ->sortable(),
                // TextColumn::make('is_admin')
                //     ->badge()
                //     ->label('Admin')
                //     ->colors([
                //         'secondary' => false,
                //         'primary' => true,
                //     ]),
            ])
            ->filters([
                Filter::make('name')
                    ->query(function (Builder $query, $value): Builder {
                        return $query->where('name', 'like', "%{$value}%");
                    }),
                Filter::make('email')
                    ->query(function (Builder $query, $value): Builder {
                        return $query->where('email', 'like', "%{$value}%");
                    }),
                Filter::make('date_of_birth')
                    ->form([
                        DatePicker::make('start_date')
                            ->label('Start Date'),
                        DatePicker::make('end_date')
                            ->label('End Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_date'],
                                fn(Builder $query, $date) => $query->whereDate('date_of_birth', '>=', $date)
                            )
                            ->when(
                                $data['end_date'],
                                fn(Builder $query, $date) => $query->whereDate('date_of_birth', '<=', $date)
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
