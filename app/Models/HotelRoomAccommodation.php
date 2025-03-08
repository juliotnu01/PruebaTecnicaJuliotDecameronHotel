<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomAccommodation extends Model
{

    protected $guarded = [];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
