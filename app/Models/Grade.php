<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;  // ← AJOUTE CETTE LIGNE

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abbreviation', 'level'];

    // Relation avec les membres
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
