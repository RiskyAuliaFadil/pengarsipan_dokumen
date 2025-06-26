<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kbli extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function nibs()
    {
        return $this->hasMany(Nib::class);
    }
}
