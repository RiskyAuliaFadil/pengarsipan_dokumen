<?php

namespace App\Filament\Resources\KbliResource\Pages;

use App\Filament\Resources\KbliResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKblis extends ListRecords
{
    protected static string $resource = KbliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
