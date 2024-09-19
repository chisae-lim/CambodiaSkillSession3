<?php

use App\Http\Controllers\ViewController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'ReservationPage']);
