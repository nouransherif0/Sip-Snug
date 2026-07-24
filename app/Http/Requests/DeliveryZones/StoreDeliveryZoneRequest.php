<?php

namespace App\Http\Requests\DeliveryZones;

use Illuminate\Foundation\Http\FormRequest;

// Defines the structure and properties of this class
class StoreDeliveryZoneRequest extends FormRequest
{
    // Checks if the current user has permission to perform this action
    public function authorize(): bool
    {
        return true;
    }

    // Specifies the validation rules that incoming data must pass
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'delivery_fee' => 'required|numeric|min:0',
            'minimum_order_value' => 'required|numeric|min:0',
            'estimated_time' => 'nullable|string',
        ];
    }
    public function messages(): array
{
    return [
        'name.required' => 'The delivery zone name is required!',
        'name.string' => 'The delivery zone name must be a string!',
        'name.max' => 'The delivery zone name can not be longer than 255 characters!',
        'delivery_fee.required' => 'The delivery fee is required!',
        'delivery_fee.numeric' => 'The delivery fee must be a number!',
        'delivery_fee.min' => 'The delivery fee must be greater than or equal to 0!',
        'minimum_order_value.required' => 'The minimum order value is required!',
        'minimum_order_value.numeric' => 'The minimum order value must be a number!',
        'minimum_order_value.min' => 'The minimum order value must be greater than or equal to 0!',
        'estimated_time.string' => 'The estimated time must be a string!',
    ];
}

}