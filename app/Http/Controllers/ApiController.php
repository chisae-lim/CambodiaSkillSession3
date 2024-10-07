<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Item;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\BookingDetail;
use App\Models\ItemPrice;

class ApiController extends Controller
{
    function searchItemByArea(Request $request)
    {
        $area_name = $request->area_name;
        $from_date = Carbon::parse($request->date)->format("Y-m-d H:i:s.u");
        $duration = intval($request->duration);
        $to_date = Carbon::parse($from_date)->addDays($duration)->format("Y-m-d H:i:s.u");


        $items = Item::whereHas('area', function ($q) use ($area_name) {
            $q->where('Name', $area_name);
        })->whereDoesntHave('prices.booking_details.booking', function ($q)  use ($from_date, $to_date) {
            $q->where('BookingDate', '>=', $from_date)
                ->where('BookingDate', '<', $to_date);
        })->with('pictures','area')
            ->get();

        return $items;
    }
}
