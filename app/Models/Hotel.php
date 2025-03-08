<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $guarded = [];

    public function habitacionesConfiguradas()
    {
        return $this->hasMany(HotelRoomAccommodation::class);
    }
}
