<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AidProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'description', 'quota', 'budget', 'start_date', 'end_date', 'status',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'budget' => 'decimal:2',
        ];
    }

    public function recipients(): HasMany
    {
        return $this->hasMany(Recipient::class);
    }
}
