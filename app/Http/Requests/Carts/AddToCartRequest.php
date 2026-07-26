<?php

namespace App\Http\Requests\Carts;

use Illuminate\Foundation\Http\FormRequest;

// Defines the structure and properties of this class
class AddToCartRequest extends FormRequest
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
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'add_ons' => 'nullable|array',
            'add_ons.*.id' => 'required|string|exists:add_ons,id',
            'add_ons.*.price_adjustment' => 'required|numeric|min:0',
            'add_ons.*.name' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Product Id is required.',
            'product_id.string' => 'Product Id must be a string.',
            'product_id.numeric' => 'Product Id must be a number.',
            'product_id.integer' => 'Product Id must be an integer.',
            'product_id.exists' => 'The selected Product Id is invalid.',
            'product_id.boolean' => 'Product Id must be true or false.',
            'product_id.array' => 'Product Id must be an array.',
            'product_id.email' => 'Product Id must be a valid email address.',
            'product_id.max' => 'Product Id exceeds the maximum allowed length.',
            'product_id.min' => 'Product Id is below the minimum allowed length.',
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
            'add_ons.required' => 'Add Ons is required.',
            'add_ons.string' => 'Add Ons must be a string.',
            'add_ons.numeric' => 'Add Ons must be a number.',
            'add_ons.integer' => 'Add Ons must be an integer.',
            'add_ons.exists' => 'The selected Add Ons is invalid.',
            'add_ons.boolean' => 'Add Ons must be true or false.',
            'add_ons.array' => 'Add Ons must be an array.',
            'add_ons.email' => 'Add Ons must be a valid email address.',
            'add_ons.max' => 'Add Ons exceeds the maximum allowed length.',
            'add_ons.min' => 'Add Ons is below the minimum allowed length.',
            'add_ons.*.id.required' => 'Add On is required.',
            'add_ons.*.id.string' => 'Add On must be a string.',
            'add_ons.*.id.numeric' => 'Add On must be a number.',
            'add_ons.*.id.integer' => 'Add On must be an integer.',
            'add_ons.*.id.exists' => 'The selected Add On is invalid.',
            'add_ons.*.id.boolean' => 'Add On must be true or false.',
            'add_ons.*.id.array' => 'Add On must be an array.',
            'add_ons.*.id.email' => 'Add On must be a valid email address.',
            'add_ons.*.id.max' => 'Add On exceeds the maximum allowed length.',
            'add_ons.*.id.min' => 'Add On is below the minimum allowed length.',
            'add_ons.*.price_adjustment.required' => 'Add On is required.',
            'add_ons.*.price_adjustment.string' => 'Add On must be a string.',
            'add_ons.*.price_adjustment.numeric' => 'Add On must be a number.',
            'add_ons.*.price_adjustment.integer' => 'Add On must be an integer.',
            'add_ons.*.price_adjustment.exists' => 'The selected Add On is invalid.',
            'add_ons.*.price_adjustment.boolean' => 'Add On must be true or false.',
            'add_ons.*.price_adjustment.array' => 'Add On must be an array.',
            'add_ons.*.price_adjustment.email' => 'Add On must be a valid email address.',
            'add_ons.*.price_adjustment.max' => 'Add On exceeds the maximum allowed length.',
            'add_ons.*.price_adjustment.min' => 'Add On is below the minimum allowed length.',
            'add_ons.*.name.required' => 'Add On is required.',
            'add_ons.*.name.string' => 'Add On must be a string.',
            'add_ons.*.name.numeric' => 'Add On must be a number.',
            'add_ons.*.name.integer' => 'Add On must be an integer.',
            'add_ons.*.name.exists' => 'The selected Add On is invalid.',
            'add_ons.*.name.boolean' => 'Add On must be true or false.',
            'add_ons.*.name.array' => 'Add On must be an array.',
            'add_ons.*.name.email' => 'Add On must be a valid email address.',
            'add_ons.*.name.max' => 'Add On exceeds the maximum allowed length.',
            'add_ons.*.name.min' => 'Add On is below the minimum allowed length.',
        ];
    }
}
