<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_id', 'distributor_id', 'distributed_at', 'status', 'documentation_photo', 'notes',
    ];

    protected function casts(): array
    {
        return ['distributed_at' => 'datetime'];
    }

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(Recipient::class);
    }

    public function distributor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'distributor_id');
    }
}
