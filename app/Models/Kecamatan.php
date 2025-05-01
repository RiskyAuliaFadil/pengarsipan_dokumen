<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = ['kota_id', 'nama'];

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class);
    }
}
