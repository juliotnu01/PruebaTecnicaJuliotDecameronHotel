<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RoomType;

class RoomTypeFactory extends Factory
{
    protected $model = RoomType::class;

    public function definition()
    {
        // Lista de nombres de tipos de habitación
        $roomTypes = ['Estándar', 'Junior', 'Suite'];

        return [
            'nombre' => $this->faker->unique()->randomElement($roomTypes),
        ];
    }
}