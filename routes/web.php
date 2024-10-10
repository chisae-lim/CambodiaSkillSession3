<?php

use App\Http\Controllers\ViewController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'ReservationPage'])->name('ReservationPage');
Route::get('/reservation/detail/item/{id_item}/date/{from_date}/duration/{darution}', [ViewController::class, 'ReservationDetailPage']);
Route::get('/reservation/payment/item/{id_item}/date/{from_date}/duration/{darution}/ppl/{ppl}', [ViewController::class, 'ReservationPaymentPage']);



Route::post('/booking/create/item/{id_item}/date/{from_date}/duration/{darution}/ppl/{ppl}',[ViewController::class, 'createBooking']);


