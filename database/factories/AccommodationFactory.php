<?php

namespace Database\Factories;

use App\Models\Accommodation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accommodation>
 */
class AccommodationFactory extends Factory
{
    protected $model = Accommodation::class;

    public function definition()
    {
        // Lista de nombres de acomodaciones
        $accommodations = ['Sencilla', 'Doble', 'Triple', 'Cuádruple'];

        return [
            'nombre' => $this->faker->unique()->randomElement($accommodations),
        ];
    }
}
