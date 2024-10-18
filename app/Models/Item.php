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
        $from_date = Carbon::parse($from_date)->format('Y-m-d');
        $to_date = Carbon::parse($from_date)->addDays(intval($duration))->format('Y-m-d');
        $query
            ->whereHas('prices', function ($q) use ($from_date, $to_date, $duration) {
                $q->where('Date', '>=', $from_date)
                    ->where('Date', '<', $to_date)
                    ->havingRaw('COUNT(DISTINCT Date) = ' . $duration)
                    ->whereDoesntHave('booking_details', function ($q) use ($from_date, $to_date) {
                        $q->where('isRefund', 0);
                    });
            })

            ->with(['pictures', 'area']);
    }

    function total($from_date, $duration)
    {
        // $from_date = Carbon::parse($from_date)->format("Y-m-d H:i:s.u");
        $total = 0;
        for ($i = 1; $i <= $duration; $i++) {
            $to_date = Carbon::parse($from_date)
                ->addDays($i - 1)
                ->format('Y-m-d H:i:s.u');

            $item_price = ItemPrice::where('ItemID', $this->ID)
                ->where('Date', '=', $to_date)
                // ->orderBy('Date', 'desc')
                ->first();
            $total += $item_price->Price;
        }
        return $total;
    }
}
