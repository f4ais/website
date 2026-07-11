<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'citizen_id', 'surveyor_id', 'scheduled_at', 'surveyed_at', 'status',
        'verified_income', 'verified_house_condition', 'verified_dependents',
        'verified_has_elderly', 'verified_has_disability', 'verified_is_single_parent',
        'notes', 'evidence_photo', 'priority_score',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'surveyed_at' => 'datetime',
            'verified_income' => 'decimal:2',
            'verified_has_elderly' => 'boolean',
            'verified_has_disability' => 'boolean',
            'verified_is_single_parent' => 'boolean',
            'priority_score' => 'integer',
        ];
    }

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(Citizen::class);
    }

    public function surveyor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'surveyor_id');
    }
}
