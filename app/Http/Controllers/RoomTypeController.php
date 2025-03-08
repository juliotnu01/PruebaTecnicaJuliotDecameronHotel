<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;
use App\Models\RoomType;
use App\Http\Resources\RoomTypeResource;
use App\Http\Resources\RoomTypeCollection;
use Inertia\Inertia;

class RoomTypeController extends Controller
{
    public function index()
    {
        $tiposHabitacion = new RoomTypeCollection(RoomType::all());
        return Inertia::render('RoomType/Index', ['tiposHabitacion' => $tiposHabitacion]);
    }

    public function create()
    {
        return Inertia::render('RoomType/Create');
    }

    public function store(StoreRoomTypeRequest $request)
    {
        $tipoHabitacion = RoomType::create($request->validated());
        return redirect()->route('tipos-habitacion.index')->with('success', 'Tipo de habitación creado exitosamente.');
    }

    public function edit(RoomType $roomType)
    {
        return Inertia::render('RoomType/Edit', ['tipoHabitacion' => new RoomTypeResource($roomType)]);
    }

    public function update(UpdateRoomTypeRequest $request, RoomType $roomType)
    {
        $roomType->update($request->validated());
        return redirect()->route('tipos-habitacion.index')->with('success', 'Tipo de habitación actualizado exitosamente.');
    }

    public function destroy(RoomType $roomType)
    {
        $roomType->delete();
        return redirect()->route('tipos-habitacion.index')->with('success', 'Tipo de habitación eliminado exitosamente.');
    }
}
