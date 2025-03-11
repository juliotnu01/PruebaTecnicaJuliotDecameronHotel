<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{HotelController, RoomTypeController, AccommodationController, HotelRoomAccommodationController};

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::middleware('web')->group(function () {
    Route::resource('hotel', HotelController::class);
    Route::resource('tipos-habitacion', RoomTypeController::class);
    Route::resource('acomodaciones', AccommodationController::class);
    Route::resource('asignaciones', HotelRoomAccommodationController::class);
    Route::delete('/hotel-room-config/{roomConfig}', [HotelController::class, 'destroyRoomConfig'])->name('hotel.room.config.destroy');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
