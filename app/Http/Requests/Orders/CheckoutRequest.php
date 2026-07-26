<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// Defines the structure and properties of this class
class CheckoutRequest extends FormRequest
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
            'address_id' => [
                'required',
                'string',
                Rule::exists('addresses', 'id')->where(function ($query) {
                    $query->where('user_id', $this->user()->id);
                }),
            ],
            'payment_method' => ['required', 'string', 'in:cash,card'],
            'saved_card_id' => ['required_if:payment_method,card', 'integer', 'exists:saved_cards,id'],
        ];
    }
    
    public function messages(): array
    {
        return [
            'address_id.required' => 'Please select a delivery address.',
            'address_id.exists' => 'The selected address is invalid or does not belong to you.',
            'payment_method.in' => 'The selected payment method is invalid.',
            'saved_card_id.required_if' => 'Please select a saved card to proceed with card payment.',
        ];
    }
}
