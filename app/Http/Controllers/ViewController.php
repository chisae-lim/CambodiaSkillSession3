<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ViewController extends Controller
{

    function ReservationPage()
    {
        $user = User::find($this->id_user);
        return view('pages.reservation', ['user' => $user]);
    }
}
