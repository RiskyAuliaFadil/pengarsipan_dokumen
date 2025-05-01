<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serpongutara = Kecamatan::where('nama', 'Serpong Utara')->first();

        $kelurahansserpongutara = [
            'Pakualam ',
            'Pakulonan',
            'Pakujaya', 
            'Jelupang', 
            'Lengkong Karya', 
            'Pondok Jagung', 
            'Pondok Jagung Timur', 
        ];

        foreach ($kelurahansserpongutara as $nama) {
            Kelurahan::create([
                'kecamatan_id' => $serpongutara->id,
                'nama' => $nama
            ]);
        }

        $serpong = Kecamatan::where('nama', 'Serpong')->first();

        $kelurahansserpong = [
            'Buaran',
            'Ciater',
            'Cilenggang', 
            'Lengkong Gudang', 
            'Lengkong Gudang Timur', 
            'Pondok Wetan', 
            'Rawa Buntu', 
            'Rawa Mekar Jaya', 
            'Serpong', 
        ];

        foreach ($kelurahansserpong as $nama) {
            Kelurahan::create([
                'kecamatan_id' => $serpong->id,
                'nama' => $nama
            ]);
        }
    }
}
