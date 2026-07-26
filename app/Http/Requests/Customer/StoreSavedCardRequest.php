<?php

namespace App\Http\Requests\Customer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

// Defines the structure and properties of this class
class StoreSavedCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // Checks if the current user has permission to perform this action
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    // Specifies the validation rules that incoming data must pass
    public function rules(): array
    {
        return [
            'card_type' => 'required|string',
            'card_name' => 'required|string',
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string',
        ];
    }
}
