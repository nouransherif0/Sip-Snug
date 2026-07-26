<?php

namespace App\Http\Requests\StoreLocations;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'badge' => 'nullable|string|max:100',
            'address' => 'sometimes|required|string|max:500',
            'days_label' => 'nullable|string|max:100',
            'opening_time' => 'sometimes|required|string|max:20',
            'closing_time' => 'sometimes|required|string|max:20',
            'phone' => 'sometimes|required|string|max:100',
            'google_maps_url' => 'sometimes|required|url|max:1000',
            'status' => 'sometimes|required|in:open,closed',
            'is_active' => 'nullable|boolean',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('is_active')) {
            $this->merge([
                'is_active' => filter_var($this->is_active, FILTER_VALIDATE_BOOLEAN),
            ]);
        }
    }
}
