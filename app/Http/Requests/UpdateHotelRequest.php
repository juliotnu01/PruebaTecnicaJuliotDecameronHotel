<?php

namespace App\Http\Requests;

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
            'nombre' => 'sometimes|required|string|max:255',
            'direccion' => 'sometimes|required|string|max:255',
            'ciudad' => 'sometimes|required|string|max:100',
            'nit' => 'sometimes|required|string|unique:hotels,nit,' . $this->route('hotel')->id,
            'numero_habitaciones' => 'sometimes|required|integer|min:1',
            'habitaciones_configuradas' => 'nullable|array',
            'habitaciones_configuradas.*.room_type_id' => 'required|exists:room_types,id',
            'habitaciones_configuradas.*.accommodation_id' => 'required|exists:accommodations,id',
            'habitaciones_configuradas.*.cantidad' => 'required|integer|min:1',
        ];
    }
}
