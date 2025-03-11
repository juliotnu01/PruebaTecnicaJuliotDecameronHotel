<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\Hotel;
use App\Http\Resources\HotelResource;
use App\Http\Resources\HotelCollection;
use App\Http\Resources\RoomTypeResource;
use App\Models\Accommodation;
use App\Models\RoomType;
use Inertia\Inertia;

class HotelController extends Controller
{
    public function index()
    {
        try {
            $roomTypes = RoomType::all();
            $hoteles = Hotel::with('habitacionesConfiguradas.roomType', 'habitacionesConfiguradas.accommodation')->get();
            return Inertia::render('Hotel/Index', [
                'hoteles' => HotelResource::collection($hoteles),
                'roomTypes' => RoomTypeResource::collection($roomTypes),
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    public function create()
    {
        // Obtener los tipos de habitación y acomodaciones
        $roomTypes = RoomType::all();
        $accommodations = Accommodation::all();

        return Inertia::render('Hotel/Create', [
            'roomTypes' => $roomTypes,
            'accommodations' => $accommodations,
        ]);
    }

    public function store(StoreHotelRequest $request)
    {
        try {
            // Validar los datos
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
        } catch (\Throwable $th) {
            // Redirigir con errores
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al crear el hotel.'. $th->getMessage()])->withInput();
        }
    }

    public function edit(Hotel $hotel)
    {
        $roomTypes = RoomType::all();
        $hotel->load('habitacionesConfiguradas.roomType', 'habitacionesConfiguradas.accommodation');
        return Inertia::render('Hotel/Edit', [
            'hotel' => new HotelResource($hotel),
            'roomTypes' => RoomTypeResource::collection($roomTypes),
        ]);
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
