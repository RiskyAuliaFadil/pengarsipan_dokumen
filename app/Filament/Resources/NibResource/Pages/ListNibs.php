<?php

namespace App\Filament\Resources\NibResource\Pages;

use App\Filament\Exports\NibExporter;
use App\Filament\Resources\NibResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ExportAction;

class ListNibs extends ListRecords
{
    protected static string $resource = NibResource::class;

    protected function getHeaderActions(): array
    {
        return [
           ExportAction::make()
                ->label('Export')
                ->exporter(NibExporter::class),
            Actions\CreateAction::make()
            ->label('Tambah')
        ];
    }
}
