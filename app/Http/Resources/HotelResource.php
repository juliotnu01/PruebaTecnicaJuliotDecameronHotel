<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'ciudad' => $this->ciudad,
            'nit' => $this->nit,
            'numero_habitaciones' => $this->numero_habitaciones,
            'habitaciones_configuradas' => HotelRoomAccommodationResource::collection($this->whenLoaded('habitacionesConfiguradas')),
        ];
    }
}