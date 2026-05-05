<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country_id'];

    // Relation avec le pays
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Relation avec les membres
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    // Relation avec les admins régionaux
    public function regionalAdmins()
    {
        return $this->hasMany(User::class, 'region_id');
    }
}
