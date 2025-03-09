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
        $hoteles = Hotel::with('habitacionesConfiguradas.roomType', 'habitacionesConfiguradas.accommodation')->get();
        return Inertia::render('Hotel/Index', ['hoteles' => HotelResource::collection($hoteles)]);
    }



    public function create()
    {
        return Inertia::render('Hotel/Create');
    }

    public function store(StoreHotelRequest $request)
    {
        // Filtra los datos permitidos para el modelo Hotel
        $hotelData = collect($request->validated())->only([
            'nombre',
            'direccion',
            'ciudad',
            'nit',
            'numero_habitaciones',
        ])->all();

        // Crear el hotel
        $hotel = Hotel::create($hotelData);

        // Guardar las habitaciones configuradas
        if ($request->has('habitaciones_configuradas')) {
            foreach ($request->input('habitaciones_configuradas') as $config) {
                $hotel->habitacionesConfiguradas()->create([
                    'room_type_id' => $config['room_type_id'],
                    'accommodation_id' => $config['accommodation_id'],
                    'cantidad' => $config['cantidad'],
                ]);
            }
        }

        return redirect()->route('hotel.index')->with('success', 'Hotel creado exitosamente.');
    }

    public function edit(Hotel $hotel)
    {
        $hotel->load('habitacionesConfiguradas.roomType', 'habitacionesConfiguradas.accommodation');
        return Inertia::render('Hotel/Edit', ['hotel' => new HotelResource($hotel)]);
    }

    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        // Actualizar el hotel
        $hotel->update($request->validated());

        // Eliminar configuraciones anteriores
        $hotel->habitacionesConfiguradas()->delete();

        // Guardar las nuevas configuraciones
        if ($request->has('habitaciones_configuradas')) {
            foreach ($request->input('habitaciones_configuradas') as $config) {
                $hotel->habitacionesConfiguradas()->create([
                    'room_type_id' => $config['room_type_id'],
                    'accommodation_id' => $config['accommodation_id'],
                    'cantidad' => $config['cantidad'],
                ]);
            }
        }

        return redirect()->route('hotel.index')->with('success', 'Hotel actualizado exitosamente.');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hoteles.index')->with('success', 'Hotel eliminado exitosamente.');
    }
}
