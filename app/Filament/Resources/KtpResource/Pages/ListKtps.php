<?php

namespace App\Filament\Resources\KtpResource\Pages;

use App\Filament\Resources\KtpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKtps extends ListRecords
{
    protected static string $resource = KtpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
