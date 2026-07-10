<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{

    protected $fillable = [
        'warga_id',
        'created_by',
        'pekerjaan',
        'penghasilan',
        'tanggungan',
        'kondisi_rumah',
        'status_rumah',
        'memiliki_kendaraan',
        'memiliki_bpjs',
        'catatan',
        'status',
        'bukti_survey',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}