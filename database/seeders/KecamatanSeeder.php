<?php

namespace Database\Seeders;

use App\Models\Kota;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tangsel = Kota::where('nama', 'Kota Tangerang Selatan')->first();

        $kecamatanstangsel = [
            'Setu',
            'Serpong',
            'Serpong Utara',
            'Pamulang',
            'Ciputat',
            'Ciputat Timur',
            'Pondok Aren',
        ];

        foreach ($kecamatanstangsel as $nama) {
            Kecamatan::create([
                'kota_id' => $tangsel->id,
                'nama' => $nama,
            ]);
        }

        $tangkot = Kota::where('nama', 'Kota Tangerang')->first();

        $kecamatanstangkot = [
            'Batuceper',
            'Benda',
            'Cibodas',
            'Ciledug',
            'Cipondoh',
            'Jatiuwung',
            'Karangtengah',
            'Karawaci',
            'Larangan',
            'Neglasari',
            'Periuk',
            'Pinang',
            'Tangerang',
        ];

        foreach ($kecamatanstangkot as $nama) {
            Kecamatan::create([
                'kota_id' => $tangkot->id,
                'nama' => $nama,
            ]);
        }
    }
}
