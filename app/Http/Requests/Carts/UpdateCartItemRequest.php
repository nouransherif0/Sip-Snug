<?php

namespace App\Http\Requests\Carts;

use Illuminate\Foundation\Http\FormRequest;

// Defines the structure and properties of this class
class UpdateCartItemRequest extends FormRequest
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
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => 'Quantity is required.',
            'quantity.string' => 'Quantity must be a string.',
            'quantity.numeric' => 'Quantity must be a number.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.exists' => 'The selected Quantity is invalid.',
            'quantity.boolean' => 'Quantity must be true or false.',
            'quantity.array' => 'Quantity must be an array.',
            'quantity.email' => 'Quantity must be a valid email address.',
            'quantity.max' => 'Quantity exceeds the maximum allowed length.',
            'quantity.min' => 'Quantity is below the minimum allowed length.',
        ];
    }
}
