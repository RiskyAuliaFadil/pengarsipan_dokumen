<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;

    protected $fillable =['no_surat', 'tgl_surat', 'perihal', 'pengirim', 'arsip_surat'];
}
