<?php

namespace App\Http\Requests;

use App\Rules\ValidRoomAccommodation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHotelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'nit' => 'required|string|unique:hotels,nit,' . $this->hotel->id,
            'numero_habitaciones' => 'required|integer|min:1',
            'habitaciones_configuradas' => 'nullable|array',
            'habitaciones_configuradas.*.room_type_id' => 'required|exists:room_types,id',
            'habitaciones_configuradas.*.accommodation_id' => 'required|exists:accommodations,id',
            'habitaciones_configuradas.*.cantidad' => 'required|integer|min:1',
            'habitaciones_configuradas.*' => new ValidRoomAccommodation(),
        ];
    }
}
