<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PublicController::class, 'map'])->name('home');

Route::get('/peta-reklame', [PublicController::class, 'map'])->name('reklame.map');
Route::get('/reklame/{project}', [PublicController::class, 'show'])->name('reklame.show');
Route::post('/booking', [PublicController::class, 'storeBooking'])->name('booking.store');