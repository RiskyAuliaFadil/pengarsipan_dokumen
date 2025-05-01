<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ktp extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_ktp',
        'nik_ktp',
        'provinsi_id',
        'kota_id',
        'kecamatan_id',
        'kelurahan_id',
        'alamat_ktp',
        'arsip_ktp',
    ];

    // RELASI KE PROVINSI
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    // RELASI KE KOTA
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    // RELASI KE KECAMATAN
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    // RELASI KE KELURAHAN
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }
}
