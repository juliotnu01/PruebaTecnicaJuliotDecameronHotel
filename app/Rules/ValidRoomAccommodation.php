<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\RoomType;
use App\Models\Accommodation;

class ValidRoomAccommodation implements ValidationRule
{
    /**
     * Ejecuta la validación.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Extraer room_type_id y accommodation_id del valor enviado
        $roomTypeId = $value['room_type_id'] ?? null;
        $accommodationId = $value['accommodation_id'] ?? null;

        // Validar que los IDs existan
        if (!$roomTypeId || !$accommodationId) {
            $fail('Los valores de tipo de habitación y acomodación son obligatorios.');
            return;
        }

        // Obtener el tipo de habitación
        $roomType = RoomType::find($roomTypeId);
        if (!$roomType) {
            $fail('El tipo de habitación seleccionado no existe.');
            return;
        }

        // Obtener la acomodación
        $accommodation = Accommodation::find($accommodationId);
        if (!$accommodation) {
            $fail('La acomodación seleccionada no existe.');
            return;
        }

        // Definir las reglas de validación por tipo de habitación
        $allowedAccommodations = $this->getAllowedAccommodations($roomType->nombre);

        // Verificar si la acomodación está permitida para el tipo de habitación
        if (!in_array($accommodation->nombre, $allowedAccommodations)) {
            $fail('La acomodación seleccionada no es válida para el tipo de habitación.');
        }
    }

    /**
     * Define las acomodaciones permitidas para cada tipo de habitación.
     *
     * @param string $roomTypeName
     * @return array
     */
    private function getAllowedAccommodations(string $roomTypeName): array
    {
        return match ($roomTypeName) {
            'Estándar' => ['Sencilla', 'Doble'],
            'Junior' => ['Triple', 'Cuádruple'],
            'Suite' => ['Sencilla', 'Doble', 'Triple'],
            default => [],
        };
    }
}