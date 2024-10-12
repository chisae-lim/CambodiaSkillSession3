<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    function item_amenities()
    {
        return $this->hasMany(ItemAmenity::class, 'ItemID');
    }

    protected function scopeAvailable(Builder $query, $from_date, $duration)
    {
        #1
        // $from_date = Carbon::parse($from_date)->format("Y-m-d H:i:s.u");
        // $to_date = Carbon::parse($from_date)->addDays(intval($duration) - 1)->format("Y-m-d H:i:s.u");

        // $query->whereHas('prices', function ($q)  use ($from_date, $to_date) {
        //     $q->where('Date', '<=', $from_date);
        // })
        // ->whereDoesntHave('prices.booking_details', function ($q)  use ($from_date, $to_date) {
        //     $q->join('bookings', 'bookings.ID', 'bookingdetails.BookingID')
        //         ->whereRaw(
        //             "(? <= DATE_ADD(BookingDate, INTERVAL (SELECT COUNT(*) FROM bookingdetails WHERE BookingID = bookings.ID)-1 DAY) AND ? >= BookingDate)",
        //             [$from_date, $to_date]
        //         );
        // })
        //     ->with(['pictures', 'area']);

        #2
        $from_date = Carbon::parse($from_date)->format("Y-m-d");
        for ($i = 1; $i <= $duration; $i++) {
            $to_date = Carbon::parse($from_date)->addDays($i - 1)->format("Y-m-d");
            $query->whereHas('prices', function ($q)  use ($to_date) {
                $q->where('Date', $to_date);
            })
                ->whereDoesntHave('prices.booking_details.price', function ($q) use ($to_date) {
                    $q->where('Date', $to_date);
                });
        }
        $query->with(['pictures', 'area']);
    }

    function total($from_date, $duration)
    {
        $from_date = Carbon::parse($from_date)->format("Y-m-d H:i:s.u");
        $total = 0;
        for ($i = 1; $i <= $duration; $i++) {
            $to_date = Carbon::parse($from_date)->addDays($i - 1)->format("Y-m-d H:i:s.u");

            $total += ItemPrice::where('ItemID', $this->ID)
                ->where('Date', '<=', $to_date)->orderBy('Date', 'desc')->first()->Price;
        }
        return  $total;
    }
}
