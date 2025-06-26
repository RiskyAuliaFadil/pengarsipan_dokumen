<?php

namespace App\Filament\Resources\KbliResource\Pages;

use App\Filament\Resources\KbliResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKbli extends ViewRecord
{
    protected static string $resource = KbliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
