<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function searchItemByArea(Request $request)
    {
        $area_name = $request->area_name;
        $from_date = $request->date;
        $duration = intval($request->duration);
        $to_date = Carbon::parse($from_date)->addDays($duration)->format("Y-m-d");


        return [$from_date, $to_date];
    }
}
