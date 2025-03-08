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

    public function hoteles()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_room_accommodations')
            ->withPivot('room_type_id', 'cantidad');
    }
}
