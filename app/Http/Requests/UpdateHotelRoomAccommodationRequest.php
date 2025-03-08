<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHotelRoomAccommodationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hotel_id' => 'sometimes|required|exists:hoteles,id',
            'room_type_id' => 'sometimes|required|exists:room_types,id',
            'accommodation_id' => [
                'sometimes|required',
                Rule::exists('accommodations', 'id')->where(function ($query) {
                    $query->where('room_type_id', $this->room_type_id);
                }),
            ],
            'cantidad' => [
                'sometimes|required',
                'integer',
                'min:1',
                new MaxRoomsPerHotelRule($this->hotel_id),
            ],
        ];
    }
}
