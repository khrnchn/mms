<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Manage';

    protected static ?string $recordTitleAttribute = 'title';

    public static function canCreate(): bool
    {
        $user = Auth::user();

        return $user->isAdmin();
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('News Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->disabled()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('news-images'),

                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'orderedList',
                                'unorderedList',
                                'h2',
                                'h3',
                            ]),

                        Forms\Components\Select::make('status')
                            ->native(false)
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->default('draft')
                            ->required()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state === 'published') {
                                    $set('published_at', now());
                                } else if ($state === 'draft') {
                                    $set('published_at', null); // Clear publish date when back to draft
                                }
                            })
                            ->live(), // Make it reactive immediately

                        Forms\Components\Toggle::make('featured')
                            ->label('Featured news')
                            ->default(false),

                        Forms\Components\DateTimePicker::make('published_at')
                            ->native(false)
                            ->label('Publish Date')
                            ->displayFormat('d/m/Y H:i') // Customize date format if needed
                            ->timezone('Asia/Kuala_Lumpur') // Set your timezone
                            ->disabled(fn(callable $get) => $get('status') === 'draft') // Optional: disable if draft
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(fn($state) => ucfirst($state))
                    ->badge()
                    ->colors([
                        'danger' => 'draft',
                        'success' => 'published',
                        'warning' => 'archived',
                    ]),

                Tables\Columns\IconColumn::make('featured')
                    ->boolean(),

                Tables\Columns\TextColumn::make('author.name')
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->formatStateUsing(fn($record) => Carbon::parse($record->start_date)->format('d F Y h:i A'))
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),

                Tables\Filters\Filter::make('featured')
                    ->query(fn(Builder $query) => $query->where('featured', true)),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->hidden(fn() => !Auth::user()->isAdmin()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn() => !Auth::user()->isAdmin()),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
