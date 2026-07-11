<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Citizen extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by', 'nik', 'family_card_number', 'name', 'gender', 'birth_date', 'address',
        'rt', 'rw', 'wilayah', 'village', 'district', 'phone', 'income', 'dependents',
        'house_condition', 'has_elderly', 'has_disability', 'is_single_parent',
        'verification_status',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'income' => 'decimal:2',
            'has_elderly' => 'boolean',
            'has_disability' => 'boolean',
            'is_single_parent' => 'boolean',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function surveys(): HasMany
    {
        return $this->hasMany(Survey::class);
    }

    public function latestSurvey()
    {
        return $this->hasOne(Survey::class)->latestOfMany();
    }

    public function recipients(): HasMany
    {
        return $this->hasMany(Recipient::class);
    }

    public function scopeInRegion(Builder $query, string $wilayah): Builder
    {
        return $query->where('wilayah', $wilayah);
    }
}
