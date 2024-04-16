<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $slug = 'posts';

    protected static ?string $navigationLabel = 'Post';

    protected static ?string $navigationGroup = 'Post Menu';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make([
                            Grid::make(2)->schema([
                                TextInput::make('judul_post')
                                    ->required()
                                    ->live(true, 5)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->label('Judul'),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required(),
                            ]),
                            MarkdownEditor::make('deskripsi')
                                ->required()
                                ->label('Deskripsi'),
                        ]),
                    ]),
                Group::make([
                    Section::make([
                        Select::make('user_id')
                            ->label('Choose Your Creator')
                            ->relationship('user', 'name')
                            ->required(),
                    ]),
                    Section::make([
                        Grid::make('Categories and Tags')
                            ->columns(2)
                            ->schema([
                                Select::make('category_id')
                                    ->label('Categories')
                                    ->required()
                                    ->preload()
                                    ->relationship('category', 'judul_kategori')
                                    ->createOptionForm([
                                        Section::make([
                                            TextInput::make('judul_kategori')
                                                ->label('Title')
                                                ->required()
                                                ->live(true, 5)
                                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                            TextInput::make('slug')
                                                ->label('Slug')
                                                ->dehydrated()
                                                ->disabled()
                                                ->required(),
                                        ]),
                                    ]),
                                Select::make('tag_id')
                                    ->label('Tags')
                                    ->required()
                                    ->preload()
                                    ->relationship('tag', 'judul_tag')
                                    ->createOptionForm([
                                        Section::make([
                                            TextInput::make('judul_tag')
                                                ->label('Tag Title')
                                                ->required()
                                                ->live(true, 5)
                                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                            TextInput::make('slug')
                                                ->label('Slug')
                                                ->required(),
                                        ]),
                                    ]),
                            ]),
                    ]),
                    Section::make([
                        FileUpload::make('gambar')
                            ->disk('s3')
                            ->required()
                            ->preserveFilenames()
                            ->image()
                            ->imageEditor(),
                    ]),
                ]),
                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn (?Post $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn (?Post $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul_post')
                    ->label('Judul Post')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.judul_kategori')
                    ->searchable()
                    ->sortable()
                    ->label('Categories'),

                TextColumn::make('tag.judul_tag')
                    ->searchable()
                    ->sortable()
                    ->label('Tags'),

                ImageColumn::make('gambar')
                    ->circular()
                    ->label('Gambar'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['user']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['slug', 'user.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->user) {
            $details['User'] = $record->user->name;
        }

        return $details;
    }
}
