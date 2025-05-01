<?php

namespace App\Filament\Resources\KtpResource\Pages;

use App\Filament\Exports\KtpExporter;
use App\Filament\Resources\KtpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ExportAction;

class ListKtps extends ListRecords
{
    protected static string $resource = KtpResource::class;

    protected function getHeaderActions(): array
    {
        // $queryString = request()->getQueryString();
        // $decodeQueryString = urldecode(request()->getQueryString());


        return [
            // Actions\Action::make('export')
            //     ->url(url('/export'.$decodeQueryString)),
            ExportAction::make()
                ->label('Export KTP')
                ->exporter(KtpExporter::class),
            Actions\CreateAction::make()
                ->label('Tambah')
        ];
    }
}
