<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuspectParent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parents';
    protected $fillable = [
        'name',
        'relationship',
        'residence',
        'suspect_id',
    ];

    public function suspect ()
    {
        return $this->belongsTo(Suspect::class);
    }

    public function telephoneNumbers ()
    {
        return $this->morphMany(TelephoneNumber::class, 'phoneable');
    }
}