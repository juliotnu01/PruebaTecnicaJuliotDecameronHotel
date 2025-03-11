<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomType extends Model
{
    use HasFactory;
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
