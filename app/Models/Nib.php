<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nib extends Model
{
    use HasFactory;

    protected $fillable = ['nama_nib', 'no_nib','kode_kbli','alamat_nib', 'arsip_nib'];
}

