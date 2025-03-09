<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $guarded = [];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function hotelRoomAccommodations()
    {
        return $this->hasMany(HotelRoomAccommodation::class);
    }
}
