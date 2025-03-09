<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelRoomAccommodationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'hotel_id' => $this->hotel_id,
            'hotel_nombre' => $this->hotel ? $this->hotel->nombre : null, // Nombre del hotel asociado
            'room_type' => new RoomTypeResource($this->whenLoaded('roomType')), // Usa el resource de RoomType
            'accommodation' => new AccommodationResource($this->whenLoaded('accommodation')), // Usa el resource de Accommodation
            'cantidad' => $this->cantidad,
        ];
    }
}
