<?php

namespace App\Filament\Resources\PerawatResource\Pages;

use App\Filament\Resources\PerawatResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePerawat extends CreateRecord
{
    protected static string $resource = PerawatResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
