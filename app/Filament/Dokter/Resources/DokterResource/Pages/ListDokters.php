<?php

namespace App\Filament\Dokter\Resources\DokterResource\Pages;

use App\Filament\Dokter\Resources\DokterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDokters extends ListRecords
{
    protected static string $resource = DokterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
