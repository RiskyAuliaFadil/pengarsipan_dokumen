<?php

namespace App\Filament\Resources\KtpResource\Pages;

use App\Filament\Resources\KtpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKtp extends EditRecord
{
    protected static string $resource = KtpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
