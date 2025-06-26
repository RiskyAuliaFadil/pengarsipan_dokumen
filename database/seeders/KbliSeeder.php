<?php

namespace Database\Seeders;

use App\Models\Kbli;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KbliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kbli::create([
            'nama' => '56103 - Kedai Makanan'
        ]);
        Kbli::create([
            'nama' => '56102 - Rumah/Warung Makan'
        ]);
    }
}
