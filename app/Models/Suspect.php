<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}