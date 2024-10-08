<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ViewController extends Controller
{

    function ReservationPage()
    {
        $user = User::find($this->id_user);
        return view('pages.reservation', ['user' => $user]);
    }

    function ReservationDetailPage($id_item, $date, $duration)
    {
        $user = User::find($this->id_user);

        $from_date = Carbon::parse($date)->format("Y-m-d H:i:s.u");
        $duration = intval($duration);
        $to_date = Carbon::parse($from_date)->addDays($duration)->format("Y-m-d H:i:s.u");

        $item = Item::where('ID', $id_item)
            ->whereHas('prices', function ($q)  use ($from_date, $to_date) {
                $q->whereDoesntHave('booking_details.booking', function ($q)  use ($from_date, $to_date) {
                    $q->where('BookingDate', '>=', $from_date)
                        ->where('BookingDate', '<', $to_date);
                });
            })->with(['pictures', 'area', 'current_price' => function ($q) use ($from_date) {
                $q->where('Date', '<=', $from_date);
            }])
            ->first();
        return view('pages.details', ['user' => $user, 'item' => $item]);
    }
}
