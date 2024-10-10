<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $item = Item::where('GUID', $id_item)
            ->Available($from_date, $duration)
            ->first();

        $item->total = $item->total($from_date, $duration);

        return view('pages.details', ['user' => $user, 'item' => $item, 'from_date' => $from_date, 'duration' => $duration]);
    }

    function ReservationPaymentPage($id_item, $from_date, $duration, $ppl)
    {
        $user = User::find($this->id_user);

        $item = Item::where('GUID', $id_item)
            ->Available($from_date, $duration)
            ->first();
        if (!$item) {
            return redirect()->route('ReservationPage');
        }
        $item->total = $item->total($from_date, $duration);

        return view('pages.payment', ['user' => $user, 'item' => $item, 'from_date' => $from_date, 'duration' => $duration, 'ppl' => $ppl]);
    }



    function createBooking($id_item, $from_date, $duration, $ppl)
    {

        $user = User::find($this->id_user);

        if ($duration <= 0 || $duration - intval($duration) > 0) {
            return view('pages.bookingFailed');
        }

        if (Carbon::parse($from_date)->format('d-m-Y') !== $from_date) {
            return view('pages.bookingFailed');
        }

        $item = Item::where('GUID', $id_item)
            ->Available($from_date, $duration)
            ->first();

        if (!$item) {
            return view('pages.bookingFailed');
        }

        if ($ppl < 0 && $ppl >= $item->Capacity) {
            return view('pages.bookingFailed');
        }
        try {
            DB::beginTransaction();


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return view('pages.bookingSucceed', ['user' => $user, 'item' => $item, 'from_date' => $from_date, 'duration' => $duration, 'ppl' => $ppl]);
    }
}
