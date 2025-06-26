<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nib extends Model
{
    use HasFactory;

    protected $fillable = ['nama_nib', 'no_nib','kbli_id','alamat_nib', 'arsip_nib'];

    public function kbli()
    {
        return $this->belongsTo(Kbli::class);
    }
}

