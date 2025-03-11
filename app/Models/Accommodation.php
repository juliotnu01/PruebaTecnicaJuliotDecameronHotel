<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Accommodation extends Model
{
    use HasFactory;
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
