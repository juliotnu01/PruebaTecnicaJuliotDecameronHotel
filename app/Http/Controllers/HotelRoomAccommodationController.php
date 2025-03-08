<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRoomAccommodationRequest;
use App\Http\Requests\UpdateHotelRoomAccommodationRequest;
use App\Models\HotelRoomAccommodation;
use App\Http\Resources\HotelRoomAccommodationResource;
use App\Http\Resources\HotelRoomAccommodationCollection;
use Inertia\Inertia;

class HotelRoomAccommodationController extends Controller
{
    public function index()
    {
        $asignaciones = new HotelRoomAccommodationCollection(
            HotelRoomAccommodation::with(['hotel', 'roomType', 'accommodation'])->get()
        );
        return Inertia::render('HotelRoomAccommodation/Index', ['asignaciones' => $asignaciones]);
    }

    public function create()
    {
        $hoteles = \App\Models\Hotel::all();
        $tiposHabitacion = \App\Models\RoomType::all();
        $acomodaciones = \App\Models\Accommodation::all();
        return Inertia::render('HotelRoomAccommodation/Create', [
            'hoteles' => $hoteles,
            'tiposHabitacion' => $tiposHabitacion,
            'acomodaciones' => $acomodaciones,
        ]);
    }

    public function store(StoreHotelRoomAccommodationRequest $request)
    {
        $asignacion = HotelRoomAccommodation::create($request->validated());
        return redirect()->route('asignaciones.index')->with('success', 'Asignación creada exitosamente.');
    }

    public function edit(HotelRoomAccommodation $asignacion)
    {
        $hoteles = \App\Models\Hotel::all();
        $tiposHabitacion = \App\Models\RoomType::all();
        $acomodaciones = \App\Models\Accommodation::all();
        return Inertia::render('HotelRoomAccommodation/Edit', [
            'asignacion' => new HotelRoomAccommodationResource($asignacion),
            'hoteles' => $hoteles,
            'tiposHabitacion' => $tiposHabitacion,
            'acomodaciones' => $acomodaciones,
        ]);
    }

    public function update(UpdateHotelRoomAccommodationRequest $request, HotelRoomAccommodation $asignacion)
    {
        $asignacion->update($request->validated());
        return redirect()->route('asignaciones.index')->with('success', 'Asignación actualizada exitosamente.');
    }

    public function destroy(HotelRoomAccommodation $asignacion)
    {
        $asignacion->delete();
        return redirect()->route('asignaciones.index')->with('success', 'Asignación eliminada exitosamente.');
    }
}
