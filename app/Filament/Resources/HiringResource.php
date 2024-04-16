<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HiringResource\Pages;
use App\Models\Hiring;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HiringResource extends Resource
{
    protected static ?string $model = Hiring::class;

    protected static ?string $slug = 'hirings';

    protected static ?string $navigationLabel = 'Hiring';

    protected static ?string $navigationGroup = 'Administrations';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn (?Hiring $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn (?Hiring $record): string => $record?->updated_at?->diffForHumans() ?? '-'),

                TextInput::make('nama_kandidat')
                    ->label('Nama Lengkap Kandidat')
                    ->required(),

                TextInput::make('nomor_hp_aktif_kandidat')
                    ->label('Nomor Hp Kandidat')
                    ->helperText('Nomor whatsapp yang aktif')
                    ->required(),

                Select::make('lulusan_kandidat')
                    ->label('Lulusan Kandidat')
                    ->options([
                        'SD' => 'Sekolah Dasar',
                        'SMP' => 'Sekolah Menengah Pertama',
                        'SMA/SMK' => 'Sekolah Menengah Atas/Sekolah Menengah Kejuruan',
                        'S1' => 'Sarjana dengan Strata 1',
                        'S2' => 'Sarjana dengan Strata 2',
                        'S3' => 'Sarjana dengan Strata 3',
                        'Professor' => 'professor',
                    ])
                    ->required(),

                Textarea::make('alamat_kandidat')
                    ->label('Alamat Lengkap Kandidat')
                    ->helperText('Bisa menggunakan link google maps atau penjelasan dari google maps')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_kandidat'),

                TextColumn::make('nomor_hp_aktif_kandidat'),

                TextColumn::make('lulusan_kandidat'),

                TextColumn::make('alamat_kandidat'),
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
            'index' => Pages\ListHirings::route('/'),
            'create' => Pages\CreateHiring::route('/create'),
            'edit' => Pages\EditHiring::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['user']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['user.name'];
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
