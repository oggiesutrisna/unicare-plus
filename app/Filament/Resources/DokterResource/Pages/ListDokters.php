<?php

namespace App\Filament\Resources\DokterResource\Pages;

use App\Filament\Resources\DokterResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDokters extends ListRecords
{
    protected static string $resource = DokterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
