<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerawatResource\Pages;
use App\Models\Perawat;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
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

class PerawatResource extends Resource
{
    protected static ?string $model = Perawat::class;

    protected static ?string $slug = 'perawats';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationLabel = 'Perawat';

    protected static ?string $navigationGroup = 'Administrations';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn (?Perawat $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn (?Perawat $record): string => $record?->updated_at?->diffForHumans() ?? '-'),

                TextInput::make('nama_perawat')
                    ->label('Nama Perawat')
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
                    ->options([
                        'Masih bekerja' => 'masih-bekerja',
                        'Cuti' => 'cuti',
                        'Resign' => 'resign',
                        'Dikeluarkan' => 'dikeluarkan',
                    ])
                    ->label('Status')
                    ->required(),

                Select::make('status_sip_perawat')
                    ->label('Status SIP Perawat')
                    ->options([
                        'Sedang Dalam Pengajuan' => 'sedang-dalam-pengajuan',
                        'Sedang Proses Pengerjaan' => 'proses-pengerjaan',
                        'Sedang Diambil' => 'sedang-diambil',
                        'Telah Diambil' => 'telah-diambil',
                    ])
                    ->required(),

                TextInput::make('nomor_aktif_perawat')
                    ->label('Nomor Aktif Perawat')
                    ->helperText('Nomor whatsapp yang aktif')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_perawat')
                    ->label('Nama Perawat')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('klinik_jaga')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status_sip_perawat')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nomor_aktif_perawat')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListPerawats::route('/'),
            'create' => Pages\CreatePerawat::route('/create'),
            'edit' => Pages\EditPerawat::route('/{record}/edit'),
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
