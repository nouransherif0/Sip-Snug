<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

// Defines the structure and properties of this class
class ProductFilterRequest extends FormRequest
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
            'name' => 'nullable|string|max:100',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'category' => 'nullable|in:coffee,fresh juice,matcha,refreshers,shop,smoothies',
            'category_id' => 'nullable | integer | exists:categories,id',
            'search' => 'nullable | string | max:255',
        ];
    }
    #[Override]
    public function messages(): array
    {
        return [
            'name.max' => 'The name can not be longer than 100 characters!',
            'name.string' => 'The name must be a string!',
            'min_price.min' => 'The minimum price must be greater than or equal to 0!',
            'min_price.numeric' => 'The minimum price must be a number!',
            'max_price.min' => 'The maximum price must be greater than or equal to 0!',
            'max_price.numeric' => 'The maximum price must be a number!',
            'category.in' => 'The category must be one of the following: coffee,fresh juice,matcha,refreshers,shop,smoothies!',
            'category_id.exists' => 'The category does not exist!', 
            'category_id.integer' => 'The category id must be an integer!',
            'search.max' => 'The search can not be longer than 255 characters!',
            'search.string' => 'The search must be a string!',
        ];
    }
}
