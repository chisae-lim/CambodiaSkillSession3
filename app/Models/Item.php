<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $primaryKey = 'ID';


    function area()
    {
        return $this->belongsTo(Area::class, 'AreaID');
    }

    function prices()
    {
        return $this->hasMany(ItemPrice::class, 'ItemID');
    }

    function pictures()
    {
        return $this->hasMany(ItemPicture::class, 'ItemID');
    }

    function current_price()
    {
        return $this->hasOne(ItemPrice::class, 'ItemID', 'ID')->orderBy('Date', 'desc');
    }

    function item_amenities(){
        return $this->hasMany(ItemAmenity::class,'ItemID');
    }
}
