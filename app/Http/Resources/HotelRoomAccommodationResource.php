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
            'hotel' => $this->hotel ? $this->hotel->nombre : null,
            'room_type_id' => $this->room_type_id,
            'room_type' => $this->roomType ? $this->roomType->nombre : null,
            'accommodation_id' => $this->accommodation_id,
            'accommodation' => $this->accommodation ? $this->accommodation->nombre : null,
            'cantidad' => $this->cantidad,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
