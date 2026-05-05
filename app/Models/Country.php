<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    // Relation avec les régions
    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    // Relation avec les membres (A JOUTER)
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    // Relation avec les admins nationaux
    public function nationalAdmins()
    {
        return $this->hasMany(User::class, 'country_id');
    }
}
