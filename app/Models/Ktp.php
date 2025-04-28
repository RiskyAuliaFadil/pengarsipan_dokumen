<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ktp extends Model
{
    use HasFactory;

    protected $fillable = ['nama_ktp', 'nik_ktp','provinsi','kota','kecamatan','kelurahan','alamat_ktp', 'arsip_ktp'];
}
