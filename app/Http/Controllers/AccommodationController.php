<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateAccommodationRequest;
use App\Models\Accommodation;
use App\Http\Resources\AccommodationResource;
use App\Http\Resources\AccommodationCollection;
use Inertia\Inertia;

class AccommodationController extends Controller
{
    public function index()
    {
        $acomodaciones = new AccommodationCollection(Accommodation::with('roomType')->get());
        return Inertia::render('Accommodation/Index', ['acomodaciones' => $acomodaciones]);
    }

    public function create()
    {
        $tiposHabitacion = \App\Models\RoomType::all();
        return Inertia::render('Accommodation/Create', ['tiposHabitacion' => $tiposHabitacion]);
    }

    public function store(StoreAccommodationRequest $request)
    {
        $acomodacion = Accommodation::create($request->validated());
        return redirect()->route('acomodaciones.index')->with('success', 'Acomodación creada exitosamente.');
    }

    public function edit(Accommodation $accommodation)
    {
        $tiposHabitacion = \App\Models\RoomType::all();
        return Inertia::render('Accommodation/Edit', [
            'acomodacion' => new AccommodationResource($accommodation),
            'tiposHabitacion' => $tiposHabitacion,
        ]);
    }

    public function update(UpdateAccommodationRequest $request, Accommodation $accommodation)
    {
        $accommodation->update($request->validated());
        return redirect()->route('acomodaciones.index')->with('success', 'Acomodación actualizada exitosamente.');
    }

    public function destroy(Accommodation $accommodation)
    {
        $accommodation->delete();
        return redirect()->route('acomodaciones.index')->with('success', 'Acomodación eliminada exitosamente.');
    }
}
