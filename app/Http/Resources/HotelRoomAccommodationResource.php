<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelRoomAccommodationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'hotel_id' => $this->hotel_id,
            'room_type_id' => $this->room_type_id,
            'accommodation_id' => $this->accommodation_id,
            'cantidad' => $this->cantidad,
            'room_type' => new RoomTypeResource($this->whenLoaded('roomType')),
            'accommodation' => new AccommodationResource($this->whenLoaded('accommodation')),
        ];
    }
}