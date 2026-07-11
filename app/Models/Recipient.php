<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'aid_program_id', 'citizen_id', 'determined_by', 'determined_at', 'status', 'notes',
    ];

    protected function casts(): array
    {
        return ['determined_at' => 'datetime'];
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(AidProgram::class, 'aid_program_id');
    }

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(Citizen::class);
    }

    public function determiner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'determined_by');
    }

    public function distribution(): HasOne
    {
        return $this->hasOne(Distribution::class);
    }
}
