<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramBantuan extends Model
{
    protected $fillable = [
        'nama_program',
        'deskripsi',
        'kouta',
    ];

    public function penyaluran()
    {
        return $this->hasMany(Penyaluran::class);
    }

    public function rekomendasi()
    {
        return $this->hasMany(Rekomendasi::class);
    }
}