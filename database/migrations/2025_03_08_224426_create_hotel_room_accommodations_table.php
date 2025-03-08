<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotel_room_accommodations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hoteles'); // Relación con Hotel
            $table->foreignId('room_type_id')->constrained('room_types'); // Relación con RoomType
            $table->foreignId('accommodation_id')->constrained('accommodations'); // Relación con Accommodation
            $table->integer('cantidad')->unsigned(); // Cantidad de habitaciones
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_room_accommodations');
    }
};
