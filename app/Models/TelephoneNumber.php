<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelephoneNumber extends Model
{
    use HasFactory, SoftDeletes;
    //Phoneable types: "Suspect", "Associate", "Parent", or "Spouse".
    protected $fillable = [
        'number',
        'phoneable_id',
        'phoneable_type',
    ];

    public function phoneable()
    {
        return $this->morphTo();
    }
}
