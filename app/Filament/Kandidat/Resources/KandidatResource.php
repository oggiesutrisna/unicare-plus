<?php

namespace App\Filament\Kandidat\Resources;

use App\Filament\Kandidat\Resources\KandidatResource\Pages;
use App\Models\Hiring;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KandidatResource extends Resource
{
    protected static ?string $model = Hiring::class;

    protected static ?string $navigationGroup = 'Administrations';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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
            'index' => Pages\ListKandidats::route('/'),
            'create' => Pages\CreateKandidat::route('/create'),
            'edit' => Pages\EditKandidat::route('/{record}/edit'),
        ];
    }
}
