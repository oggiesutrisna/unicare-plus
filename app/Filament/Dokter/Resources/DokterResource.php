<?php

namespace App\Filament\Dokter\Resources;

use App\Filament\Dokter\Resources\DokterResource\Pages;
use App\Models\Dokter;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DokterResource extends Resource
{
    protected static ?string $model = Dokter::class;

    protected static ?string $navigationGroup = 'Administrations';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Select::make('user_id')
                        ->label('User Choice')
                        ->relationship('users', 'name')
                        ->required(),
                ]),
                Section::make([
                    TextInput::make('nama_dokter')
                        ->label('Nama Lengkap Dokter')
                        ->required(),

                    Select::make('status_sip_dokter')
                        ->label('Status SIP Dokter')
                        ->options([
                            'Sedang Dalam Pengajuan' => 'sedang-dalam-pengajuan',
                            'Sedang Proses Pengerjaan' => 'proses-pengerjaan',
                            'Sedang Diambil' => 'sedang-diambil',
                            'Telah Diambil' => 'telah-diambil',
                        ])
                        ->required(),

                    Select::make('klinik_jaga')
                        ->label('Klinik Jaga')
                        ->options([
                            'Unicare Uluwatu' => 'unicare-uluwatu',
                            'Unicare Ubud' => 'unicare-ubud',
                            'Unicare Nusa Dua' => 'unicare-nusa-dua',
                            'Unicare Central Parkir' => 'unicare-central-parkir',
                            'Unicare Tambolaka' => 'unicare-tambolaka',
                            'Unicare Labuan Bajo' => 'unicare-labuan-bajo',
                            'Hydromedical Canggu' => 'hydromedical-canggu',
                            'Hydromedical Batu Belig Lama' => 'hydromedical-batu-belig-lama',
                            'Hydromedical Batu Belig Baru' => 'hydromedical-batu-belig-baru',
                            'Hydromedical Batu Bolong' => 'hydromedical-batu-bolong',
                            'Hydromedical Berawa' => 'hydromedical-berawa',
                            'Hydromedical Lippo Mall' => 'hydromedical-Lippo Mall',
                        ])
                        ->required(),

                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'Masih bekerja' => 'masih-bekerja',
                            'Resign' => 'resign',
                            'Dikeluarkan' => 'dikeluarkan',
                        ])
                        ->required(),

                    Select::make('spesialis')
                        ->label('Spesialis')
                        ->options([
                            'Spesialis Dokter Gigi' => 'Spesialis Dokter Gigi',
                        ])
                        ->required(),
                ]),
                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn (?Dokter $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn (?Dokter $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
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
            'index' => Pages\ListDokters::route('/'),
            'create' => Pages\CreateDokter::route('/create'),
            'edit' => Pages\EditDokter::route('/{record}/edit'),
        ];
    }
}
