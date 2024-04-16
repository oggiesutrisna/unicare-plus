<?php

namespace App\Filament\Kandidat\Resources\KandidatResource\Pages;

use App\Filament\Kandidat\Resources\KandidatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKandidat extends EditRecord
{
    protected static string $resource = KandidatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
