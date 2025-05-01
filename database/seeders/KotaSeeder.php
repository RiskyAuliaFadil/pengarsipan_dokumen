<?php

namespace Database\Seeders;

use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banten = Provinsi::where('nama', 'Banten')->first();

        $kabupatens = [
            'Kabupaten Pandeglang',
            'Kabupaten Lebak',
            'Kabupaten Tangerang',
            'Kabupaten Serang',
            'Kota Tangerang',
            'Kota Tangerang Selatan',
            'Kota Cilegon',
            'Kota Serang',
        ];

        foreach ($kabupatens as $nama) {
            Kota::create([
                'provinsi_id' => $banten->id,
                'nama' => $nama,
            ]);
    }
}
}