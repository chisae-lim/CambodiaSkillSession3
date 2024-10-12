<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use App\Models\Booking;
use App\Models\ItemPrice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BookingDetail;
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

        $error_view = view('pages.bookingFailed', ['user' => $user]);

        if ($duration <= 0 || $duration - intval($duration) > 0) {
            return $error_view;
        }

        if (Carbon::parse($from_date)->format('d-m-Y') !== $from_date) {
            return $error_view;
        }

        $item = Item::where('GUID', $id_item)
            ->Available($from_date, $duration)
            ->first();

        if (!$item) {
            return $error_view;
        }

        if ($ppl < 0 && $ppl >= $item->Capacity) {
            return $error_view;
        }
        try {
            DB::beginTransaction();
            $last_booking_id = Booking::orderBy('ID', 'desc')->first()->ID;
            Booking::create([
                'ID' => $last_booking_id + 1,
                'GUID' => strtoupper(Str::uuid()),
                'UserID' => $user->ID,
                'BookingDate' => Carbon::parse($from_date)->format("Y-m-d H:i:s.u"),
                'AmountPaid' => $item->total($from_date, $duration),
            ]);

            for ($i = 1; $i <= $duration; $i++) {

                $to_date = Carbon::parse($from_date)->addDays($i - 1)->format("Y-m-d H:i:s.u");

                $item_price = ItemPrice::where('ItemID', $item->ID)
                    ->where('Date', '<=', $to_date)->orderBy('Date', 'desc')->first();

                $last_booking_detail_id = BookingDetail::orderBy('ID', 'desc')->first()->ID;


                BookingDetail::create([
                    'ID' => $last_booking_detail_id + 1,
                    'GUID' => strtoupper(Str::uuid()),
                    'BookingID' =>  $last_booking_id + 1,
                    'ItemPriceID' => $item_price->ID,
                    'isRefund' => 0,
                ]);
            }

            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return view('pages.bookingSucceed', ['user' => $user, 'item' => $item, 'from_date' => $from_date, 'duration' => $duration, 'ppl' => $ppl]);
    }
}
