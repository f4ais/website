<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_RTRW = 'rtrw';
    public const ROLE_SURVEYOR = 'surveyor';
    public const ROLE_PENYALUR = 'penyalur';

    protected $fillable = [
        'name', 'email', 'password', 'role', 'wilayah', 'is_active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function citizens(): HasMany
    {
        return $this->hasMany(Citizen::class, 'created_by');
    }

    public function surveys(): HasMany
    {
        return $this->hasMany(Survey::class, 'surveyor_id');
    }

    public function distributions(): HasMany
    {
        return $this->hasMany(Distribution::class, 'distributor_id');
    }

    public function determinedRecipients(): HasMany
    {
        return $this->hasMany(Recipient::class, 'determined_by');
    }

    public function isRole(string $role): bool
    {
        return $this->role === $role;
    }
}
