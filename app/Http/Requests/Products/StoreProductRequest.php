<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

// Defines the structure and properties of this class
class StoreProductRequest extends FormRequest
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
            'subcategory_id' => 'required|integer|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'stock' => 'nullable|integer|min:20',
            'is_featured' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'subcategory_id.required' => 'Subcategory Id is required.',
            'subcategory_id.string' => 'Subcategory Id must be a string.',
            'subcategory_id.numeric' => 'Subcategory Id must be a number.',
            'subcategory_id.integer' => 'Subcategory Id must be an integer.',
            'subcategory_id.exists' => 'The selected Subcategory Id is invalid.',
            'subcategory_id.boolean' => 'Subcategory Id must be true or false.',
            'subcategory_id.array' => 'Subcategory Id must be an array.',
            'subcategory_id.email' => 'Subcategory Id must be a valid email address.',
            'subcategory_id.max' => 'Subcategory Id exceeds the maximum allowed length.',
            'subcategory_id.min' => 'Subcategory Id is below the minimum allowed length.',
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
            'description.required' => 'Description is required.',
            'description.string' => 'Description must be a string.',
            'description.numeric' => 'Description must be a number.',
            'description.integer' => 'Description must be an integer.',
            'description.exists' => 'The selected Description is invalid.',
            'description.boolean' => 'Description must be true or false.',
            'description.array' => 'Description must be an array.',
            'description.email' => 'Description must be a valid email address.',
            'description.max' => 'Description exceeds the maximum allowed length.',
            'description.min' => 'Description is below the minimum allowed length.',
            'price.required' => 'Price is required.',
            'price.string' => 'Price must be a string.',
            'price.numeric' => 'Price must be a number.',
            'price.integer' => 'Price must be an integer.',
            'price.exists' => 'The selected Price is invalid.',
            'price.boolean' => 'Price must be true or false.',
            'price.array' => 'Price must be an array.',
            'price.email' => 'Price must be a valid email address.',
            'price.max' => 'Price exceeds the maximum allowed length.',
            'price.min' => 'Price is below the minimum allowed length.',
            'image.required' => 'Image is required.',
            'image.string' => 'Image must be a string.',
            'image.numeric' => 'Image must be a number.',
            'image.integer' => 'Image must be an integer.',
            'image.exists' => 'The selected Image is invalid.',
            'image.boolean' => 'Image must be true or false.',
            'image.array' => 'Image must be an array.',
            'image.email' => 'Image must be a valid email address.',
            'image.max' => 'Image exceeds the maximum allowed length.',
            'image.min' => 'Image is below the minimum allowed length.',
            'stock.required' => 'Stock is required.',
            'stock.string' => 'Stock must be a string.',
            'stock.numeric' => 'Stock must be a number.',
            'stock.integer' => 'Stock must be an integer.',
            'stock.exists' => 'The selected Stock is invalid.',
            'stock.boolean' => 'Stock must be true or false.',
            'stock.array' => 'Stock must be an array.',
            'stock.email' => 'Stock must be a valid email address.',
            'stock.max' => 'Stock exceeds the maximum allowed length.',
            'stock.min' => 'Stock is below the minimum allowed length.',
            'is_featured.required' => 'Is Featured is required.',
            'is_featured.string' => 'Is Featured must be a string.',
            'is_featured.numeric' => 'Is Featured must be a number.',
            'is_featured.integer' => 'Is Featured must be an integer.',
            'is_featured.exists' => 'The selected Is Featured is invalid.',
            'is_featured.boolean' => 'Is Featured must be true or false.',
            'is_featured.array' => 'Is Featured must be an array.',
            'is_featured.email' => 'Is Featured must be a valid email address.',
            'is_featured.max' => 'Is Featured exceeds the maximum allowed length.',
            'is_featured.min' => 'Is Featured is below the minimum allowed length.',
        ];
    }
}
