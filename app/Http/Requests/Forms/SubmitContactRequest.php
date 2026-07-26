<?php

namespace App\Http\Requests\Forms;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

// Defines the structure and properties of this class
class SubmitContactRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }
}
