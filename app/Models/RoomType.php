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

    public function hoteles()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_room_accommodations')
            ->withPivot('accommodation_id', 'cantidad');
    }
}
