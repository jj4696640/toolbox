<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suspect extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'case_ref',
        'station',
        'offence',
        'briefs_on_case',
        'name',
        'sex',
        'age',
        'nationality',
        'nin',
        'other_id_no',
        'tribe',
        'religion',
        'marital_status',
        'place_of_birth',
        'present_address',
        'distinguishing_features',
        'height',
        'bodybuild',
        'eye_color',
        'hair_color',
        'level_of_education',
        'languages_spoken',
        'travel_history',
        'previous_crime_records',
        'occupation',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function associates()
    {
        return $this->hasMany(Associate::class);
    }

    public function spouses()
    {
        return $this->hasMany(Spouse::class);
    }

    public function parents()
    {
        return $this->hasMany(SuspectParent::class);
    }

    public function telephoneNumbers()
    {
        return $this->morphMany(TelephoneNumber::class, 'phoneable');
    }
}