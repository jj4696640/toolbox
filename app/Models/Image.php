<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image_path',
        'position',
        'suspect_id',
    ];

    public function suspect()
    {
        return $this->belongsTo(Suspect::class);
    }
}
