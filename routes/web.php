<?php

use App\Http\Controllers\ViewController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'ReservationPage']);
Route::get('/items/detail/{id_item}/date/{from_date}/duration/{darution}', [ViewController::class, 'ReservationDetailPage']);
