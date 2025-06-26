<?php

namespace App\Filament\Resources\SuratResource\Pages;

use App\Filament\Exports\SuratExporter;
use App\Filament\Resources\SuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ExportAction;

class ListSurats extends ListRecords
{
    protected static string $resource = SuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->label('Export')
                ->exporter(SuratExporter::class),
            Actions\CreateAction::make()
            -> label('Tambah')
        ];
    }
}
