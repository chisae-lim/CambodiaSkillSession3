<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Item;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function searchItemByArea(Request $request)
    {
        $area_name = $request->area_name;
        $from_date = $request->date;
        $duration = intval($request->duration);
        $to_date = Carbon::parse($from_date)->addDays($duration)->format("Y-m-d");

        $items = Item::whereHas('area', function ($q) use ($area_name) {
            $q->where('Name', $area_name);
        })->with('prices')->get();

        return $items;
    }
}
