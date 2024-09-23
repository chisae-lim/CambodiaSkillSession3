<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'areas';
    protected $primaryKey = 'ID';

    function items(){
        return $this->hasMany(Item::class,'AreaID','ID');
    }
}
