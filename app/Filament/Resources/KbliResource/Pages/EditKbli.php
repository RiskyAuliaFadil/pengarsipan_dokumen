<?php

namespace App\Filament\Resources\KbliResource\Pages;

use App\Filament\Resources\KbliResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKbli extends EditRecord
{
    protected static string $resource = KbliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
