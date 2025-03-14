<?php

namespace App\Http\Requests;

use App\Rules\ValidRoomAccommodation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreHotelRequest extends FormRequest
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
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'nit' => 'required|string|unique:hotels,nit',
            'numero_habitaciones' => 'required|integer|min:1',
            'habitaciones_configuradas' => 'nullable|array',
            'habitaciones_configuradas.*.room_type_id' => 'required|exists:room_types,id',
            'habitaciones_configuradas.*.accommodation_id' => 'required|exists:accommodations,id',
            'habitaciones_configuradas.*.cantidad' => 'required|integer|min:1',
            'habitaciones_configuradas.*' => new ValidRoomAccommodation(),
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'habitaciones_configuradas' => $this->habitaciones_configuradas,
        ]);
    }
    protected function failedValidation(Validator $validator)
    {
        // Devolver los errores con una redirección compatible con Inertia.js
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator->errors())->withInput()
        );
    }
}
