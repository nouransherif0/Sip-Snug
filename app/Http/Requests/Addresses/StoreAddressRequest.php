<?php

namespace App\Http\Requests\Addresses;

use Illuminate\Foundation\Http\FormRequest;

// Defines the structure and properties of this class
class StoreAddressRequest extends FormRequest
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
            'delivery_zone_id' => 'required|integer|exists:delivery_zones,id',
            'street' => 'required|string|min:3|max:255',
            'building_number' => 'required|string|max:50',
            'phone_number' => ['required', 'string', 'regex:/^01[0125][0-9]{8}$/'],
            'label' => 'nullable|string|max:100',
            'floor' => 'nullable|string|max:50',
            'apartment' => 'nullable|string|max:50',
            'landmark' => 'nullable|string|max:255',
            'is_default' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'delivery_zone_id.required' => 'Delivery Zone Id is required.',
            'delivery_zone_id.string' => 'Delivery Zone Id must be a string.',
            'delivery_zone_id.numeric' => 'Delivery Zone Id must be a number.',
            'delivery_zone_id.integer' => 'Delivery Zone Id must be an integer.',
            'delivery_zone_id.exists' => 'The selected Delivery Zone Id is invalid.',
            'delivery_zone_id.boolean' => 'Delivery Zone Id must be true or false.',
            'delivery_zone_id.array' => 'Delivery Zone Id must be an array.',
            'delivery_zone_id.email' => 'Delivery Zone Id must be a valid email address.',
            'delivery_zone_id.max' => 'Delivery Zone Id exceeds the maximum allowed length.',
            'delivery_zone_id.min' => 'Delivery Zone Id is below the minimum allowed length.',
            'street.required' => 'Street is required.',
            'street.string' => 'Street must be a string.',
            'street.numeric' => 'Street must be a number.',
            'street.integer' => 'Street must be an integer.',
            'street.exists' => 'The selected Street is invalid.',
            'street.boolean' => 'Street must be true or false.',
            'street.array' => 'Street must be an array.',
            'street.email' => 'Street must be a valid email address.',
            'street.max' => 'Street exceeds the maximum allowed length.',
            'street.min' => 'Street is below the minimum allowed length.',
            'building_number.required' => 'Building Number is required.',
            'building_number.string' => 'Building Number must be a string.',
            'building_number.numeric' => 'Building Number must be a number.',
            'building_number.integer' => 'Building Number must be an integer.',
            'building_number.exists' => 'The selected Building Number is invalid.',
            'building_number.boolean' => 'Building Number must be true or false.',
            'building_number.array' => 'Building Number must be an array.',
            'building_number.email' => 'Building Number must be a valid email address.',
            'building_number.max' => 'Building Number exceeds the maximum allowed length.',
            'building_number.min' => 'Building Number is below the minimum allowed length.',
            'phone_number.required' => 'Phone Number is required.',
            'phone_number.string' => 'Phone Number must be a string.',
            'phone_number.regex' => 'Phone Number must be a valid Egyptian mobile number (e.g. 010, 011, 012, 015) with exactly 11 digits.',
            'phone_number.integer' => 'Phone Number must be an integer.',
            'phone_number.exists' => 'The selected Phone Number is invalid.',
            'phone_number.boolean' => 'Phone Number must be true or false.',
            'phone_number.array' => 'Phone Number must be an array.',
            'phone_number.email' => 'Phone Number must be a valid email address.',
            'phone_number.max' => 'Phone Number exceeds the maximum allowed length.',
            'phone_number.min' => 'Phone Number is below the minimum allowed length.',
            'label.required' => 'Label is required.',
            'label.string' => 'Label must be a string.',
            'label.numeric' => 'Label must be a number.',
            'label.integer' => 'Label must be an integer.',
            'label.exists' => 'The selected Label is invalid.',
            'label.boolean' => 'Label must be true or false.',
            'label.array' => 'Label must be an array.',
            'label.email' => 'Label must be a valid email address.',
            'label.max' => 'Label exceeds the maximum allowed length.',
            'label.min' => 'Label is below the minimum allowed length.',
            'floor.required' => 'Floor is required.',
            'floor.string' => 'Floor must be a string.',
            'floor.numeric' => 'Floor must be a number.',
            'floor.integer' => 'Floor must be an integer.',
            'floor.exists' => 'The selected Floor is invalid.',
            'floor.boolean' => 'Floor must be true or false.',
            'floor.array' => 'Floor must be an array.',
            'floor.email' => 'Floor must be a valid email address.',
            'floor.max' => 'Floor exceeds the maximum allowed length.',
            'floor.min' => 'Floor is below the minimum allowed length.',
            'apartment.required' => 'Apartment is required.',
            'apartment.string' => 'Apartment must be a string.',
            'apartment.numeric' => 'Apartment must be a number.',
            'apartment.integer' => 'Apartment must be an integer.',
            'apartment.exists' => 'The selected Apartment is invalid.',
            'apartment.boolean' => 'Apartment must be true or false.',
            'apartment.array' => 'Apartment must be an array.',
            'apartment.email' => 'Apartment must be a valid email address.',
            'apartment.max' => 'Apartment exceeds the maximum allowed length.',
            'apartment.min' => 'Apartment is below the minimum allowed length.',
            'landmark.required' => 'Landmark is required.',
            'landmark.string' => 'Landmark must be a string.',
            'landmark.numeric' => 'Landmark must be a number.',
            'landmark.integer' => 'Landmark must be an integer.',
            'landmark.exists' => 'The selected Landmark is invalid.',
            'landmark.boolean' => 'Landmark must be true or false.',
            'landmark.array' => 'Landmark must be an array.',
            'landmark.email' => 'Landmark must be a valid email address.',
            'landmark.max' => 'Landmark exceeds the maximum allowed length.',
            'landmark.min' => 'Landmark is below the minimum allowed length.',
            'is_default.required' => 'Is Default is required.',
            'is_default.string' => 'Is Default must be a string.',
            'is_default.numeric' => 'Is Default must be a number.',
            'is_default.integer' => 'Is Default must be an integer.',
            'is_default.exists' => 'The selected Is Default is invalid.',
            'is_default.boolean' => 'Is Default must be true or false.',
            'is_default.array' => 'Is Default must be an array.',
            'is_default.email' => 'Is Default must be a valid email address.',
            'is_default.max' => 'Is Default exceeds the maximum allowed length.',
            'is_default.min' => 'Is Default is below the minimum allowed length.',
        ];
    }
}
