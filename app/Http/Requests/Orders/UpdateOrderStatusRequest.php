<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// Defines the structure and properties of this class
class UpdateOrderStatusRequest extends FormRequest
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
            'status' => [
                'required',
                'string',
                Rule::in(['pending', 'confirmed', 'preparing', 'out_for_delivery', 'delivered', 'cancelled']),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status is required.',
            'status.string' => 'Status must be a string.',
            'status.numeric' => 'Status must be a number.',
            'status.integer' => 'Status must be an integer.',
            'status.exists' => 'The selected Status is invalid.',
            'status.boolean' => 'Status must be true or false.',
            'status.array' => 'Status must be an array.',
            'status.email' => 'Status must be a valid email address.',
            'status.max' => 'Status exceeds the maximum allowed length.',
            'status.min' => 'Status is below the minimum allowed length.',
        ];
    }
}
