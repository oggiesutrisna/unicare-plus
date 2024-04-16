<?php

namespace App\Filament\Resources\PerawatResource\Pages;

use App\Filament\Resources\PerawatResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPerawat extends EditRecord
{
    protected static string $resource = PerawatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
