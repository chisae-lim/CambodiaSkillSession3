<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $primaryKey = 'ID';


    function area(){
        return $this->belongsTo(Area::class, 'AreaID','ID');
    }

    function prices(){
        return $this->hasMany(ItemPrice::class,'ItemID', 'ID');
    }
}
