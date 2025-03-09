<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $guarded = [];

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }

    public function hotelRoomAccommodations()
    {
        return $this->hasMany(HotelRoomAccommodation::class);
    }
}
