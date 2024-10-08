<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemAmenity extends Model
{
    use HasFactory;
    protected $table = 'itemamenities';
    protected $primaryKey = 'ID';

    function amenity()
    {
        return $this->belongsTo(Amenity::class, 'AmenityID');
    }
}
