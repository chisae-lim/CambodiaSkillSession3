<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $primaryKey = 'ID';

    public $timestamps = false;
    protected $fillable = [
        'ID',
        'GUID',
        'UserID',
        'BookingDate',
        'AmountPaid'
    ];
}
