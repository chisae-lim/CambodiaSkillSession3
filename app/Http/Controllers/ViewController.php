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

    function ReservationDetailPage($id_item, $from_date, $duration)
    {
        $user = User::find($this->id_user);

        $item = Item::where('ID', $id_item)
            ->Available($from_date, $duration)
            ->first();

        return view('pages.details', ['user' => $user, 'item' => $item, 'from_date' => $from_date, 'duration' => $duration]);
    }
}
