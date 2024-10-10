<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Item;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\BookingDetail;
use App\Models\ItemPrice;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{
    function searchItemByArea(Request $request)
    {
        $area_name = $request->area_name;
        $from_date = $request->from_date;
        $duration = $request->duration;
        if ($duration <= 0 || $duration - intval($duration) > 0) {
            abort(417, 'The duration is not a valid number!');
        }
        if (Carbon::parse($from_date)->format('d-m-Y') !== $from_date) {
            abort(417, 'The date is not valid!');
        }
        $items = Item::whereHas('area', function ($q) use ($area_name) {
            $q->where('Name', 'like', '%' . $area_name . '%');
        })->Available($from_date, $duration)
            ->get();


        // loop
        foreach ($items as $item) {
            $item->total = $item->total($from_date, $duration);
        }
        return response($items, 200);
    }
}
