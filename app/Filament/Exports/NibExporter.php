<?php

namespace App\Filament\Exports;

use App\Models\Nib;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class NibExporter extends Exporter
{
    protected static ?string $model = Nib::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('nama_nib')
                ->label('Nama'),
            ExportColumn::make('no_nib')
                ->label('NIB'),
            ExportColumn::make('kbli.nama')
                ->label('Kode KBLI'),
            ExportColumn::make('alamat_nib')
                ->label('Alamat'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your nib export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
