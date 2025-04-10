<?php

namespace App\Filament\Resources\NibResource\Pages;

use App\Filament\Resources\NibResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNibs extends ListRecords
{
    protected static string $resource = NibResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
