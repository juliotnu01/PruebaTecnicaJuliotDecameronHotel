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
    // Rutas para Hoteles
    Route::resource('hoteles', HotelController::class);

    // Rutas para Tipos de Habitación
    Route::resource('tipos-habitacion', RoomTypeController::class);

    // Rutas para Acomodaciones
    Route::resource('acomodaciones', AccommodationController::class);

    // Rutas para Asignaciones de Habitaciones
    Route::resource('asignaciones', HotelRoomAccommodationController::class);
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
