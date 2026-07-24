<?php

namespace App\Http\Requests\Subcategories;

use Illuminate\Foundation\Http\FormRequest;

// Defines the structure and properties of this class
class UpdateSubcategoryRequest extends FormRequest
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
            'category_id' => 'sometimes|required|integer|exists:categories,id',
            'name' => 'sometimes|required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Category Id is required.',
            'category_id.string' => 'Category Id must be a string.',
            'category_id.numeric' => 'Category Id must be a number.',
            'category_id.integer' => 'Category Id must be an integer.',
            'category_id.exists' => 'The selected Category Id is invalid.',
            'category_id.boolean' => 'Category Id must be true or false.',
            'category_id.array' => 'Category Id must be an array.',
            'category_id.email' => 'Category Id must be a valid email address.',
            'category_id.max' => 'Category Id exceeds the maximum allowed length.',
            'category_id.min' => 'Category Id is below the minimum allowed length.',
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.numeric' => 'Name must be a number.',
            'name.integer' => 'Name must be an integer.',
            'name.exists' => 'The selected Name is invalid.',
            'name.boolean' => 'Name must be true or false.',
            'name.array' => 'Name must be an array.',
            'name.email' => 'Name must be a valid email address.',
            'name.max' => 'Name exceeds the maximum allowed length.',
            'name.min' => 'Name is below the minimum allowed length.',
        ];
    }
}
