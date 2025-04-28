<?php

namespace App\Filament\Widgets;

use App\Models\Ktp;
use App\Models\Nib;
use App\Models\Surat;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        $countKtp = Ktp::count();
        $countNib = Nib::count();
        $countSurat = Surat::count();
        return [
            Stat::make('Jumlah KTP', $countKtp . ' KTP'),
            Stat::make('Jumlah NIB', $countNib . ' NIB'),
            Stat::make('Jumlah Surat', $countSurat . ' Surat'),
        ];
    }
}
