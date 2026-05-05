<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'country_id', 'region_id',
        'is_active', 'created_by', 'last_login_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Relations
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function createdMembers()
    {
        return $this->hasMany(Member::class, 'created_by');
    }

    // Vérifications de rôle
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isNationalAdmin()
    {
        return $this->role === 'national_admin';
    }

    public function isRegionalAdmin()
    {
        return $this->role === 'regional_admin';
    }

    // Scope pour les utilisateurs actifs
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
