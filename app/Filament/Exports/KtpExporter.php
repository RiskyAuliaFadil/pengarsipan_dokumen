<?php

namespace App\Filament\Exports;

use App\Models\Ktp;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class KtpExporter extends Exporter
{
    protected static ?string $model = Ktp::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('nama_ktp')
                ->label('Nama'),
            ExportColumn::make('nik_ktp')
                ->label('NIK'),
            ExportColumn::make('provinsi.nama')
                ->label('Provinsi'),
            ExportColumn::make('kota.nama')
                ->label('Kota'),
            ExportColumn::make('kecamatan.nama')
                ->label('Kecamatan'),
            ExportColumn::make('kelurahan.nama')
                ->label('Kelurahan'),
            ExportColumn::make('alamat_ktp')
                ->label('Alamat'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your ktp export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
