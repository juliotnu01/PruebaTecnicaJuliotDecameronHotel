<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\Hotel;
use App\Http\Resources\HotelResource;
use App\Http\Resources\HotelCollection;
use Inertia\Inertia;

class HotelController extends Controller
{
    public function index()
    {
        $hoteles = new HotelCollection(Hotel::all());
        return Inertia::render('Hotel/Index', ['hoteles' => $hoteles]);
    }

    public function create()
    {
        return Inertia::render('Hotel/Create');
    }

    public function store(StoreHotelRequest $request)
    {
        $hotel = Hotel::create($request->validated());
        return redirect()->route('hoteles.index')->with('success', 'Hotel creado exitosamente.');
    }

    public function edit(Hotel $hotel)
    {
        return Inertia::render('Hotel/Edit', ['hotel' => new HotelResource($hotel)]);
    }

    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        $hotel->update($request->validated());
        return redirect()->route('hoteles.index')->with('success', 'Hotel actualizado exitosamente.');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hoteles.index')->with('success', 'Hotel eliminado exitosamente.');
    }
}