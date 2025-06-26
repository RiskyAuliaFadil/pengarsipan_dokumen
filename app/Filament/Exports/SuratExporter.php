<?php

namespace App\Filament\Exports;

use App\Models\Surat;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SuratExporter extends Exporter
{
    protected static ?string $model = Surat::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('no_surat')
                ->label('No Surat'),
            ExportColumn::make('tgl_surat')
                ->label('Tanggal'),
            ExportColumn::make('perihal')
                ->label('Perihal'),
            ExportColumn::make('pengirim')
                ->label('Pengirim'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your surat export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
