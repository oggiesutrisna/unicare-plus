<?php

namespace App\Filament\Resources\HiringResource\Pages;

use App\Filament\Resources\HiringResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHiring extends CreateRecord
{
    protected static string $resource = HiringResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
