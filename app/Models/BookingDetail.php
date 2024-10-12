<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $table = 'bookingdetails';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'GUID',
        'BookingID',
        'ItemPriceID',
        'isRefund'

    ];
    function booking()
    {
        return $this->belongsTo(Booking::class, 'BookingID');
    }

    function price()
    {
        return $this->belongsTo(ItemPrice::class, 'ItemPriceID');
    }
}
