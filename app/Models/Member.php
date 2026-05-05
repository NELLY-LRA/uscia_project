<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Country;  
use App\Models\Region;   
use App\Models\Grade;    
use App\Models\User;     
use App\Models\Document; 
class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'last_name', 'first_name', 'gender', 'date_of_birth', 'blood_group',
        'nationality', 'email', 'phone', 'address', 'nearest_police_station',
        'passport_number', 'cni_number', 'citizenship_id', 'occupation',
        'educational_level', 'organization', 'uscia_number', 'grade_name',
        'grade_id', 'membership_date', 'country_id', 'region_id',
        'cv_path', 'letter_of_recommendation_path', 'criminal_record_path',
        'photo_path', 'has_been_convicted', 'conviction_details',
        'is_pastor', 'religious_denomination', 'created_by', 'updated_by'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'membership_date' => 'date',
        'has_been_convicted' => 'boolean',
        'is_pastor' => 'boolean'
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

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
