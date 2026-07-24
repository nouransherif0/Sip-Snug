<?php

namespace App\Http\Requests\AddOns;

use Illuminate\Foundation\Http\FormRequest;

// Defines the structure and properties of this class
class UpdateAddOnRequest extends FormRequest
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
    'name' => 'sometimes|required|string|max:255',
    'price_adjustment' => 'sometimes|required|numeric|min:0',
   ];
    }
  public function messages(): array{
    return[
      'name.max' => 'The name can not be longer than 100 characters!',
      'name.string' => 'The name must be a string!',
      'name.required' => 'The name must not be empty!',
      'price_adjustment.min' => 'The price_adjustment can not hold -ve value!',
      'price_adjustment.numeric' => 'The nprice_adjustmentame must be a number!',
      'price_adjustment.required' => 'The price_adjustment must not be empty!',

    ];
   } 
}