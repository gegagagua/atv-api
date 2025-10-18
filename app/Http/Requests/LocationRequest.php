<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $locationId = $this->route('location') ? $this->route('location')->id : null;
        
        return [
            'name' => 'required|string|max:255|min:2',
            'country' => 'required|string|max:255|min:2',
            'region' => 'nullable|string|max:255',
            'type' => 'required|string|in:city,region,country',
            'is_georgian' => 'boolean',
            'is_active' => 'boolean',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The location name is required.',
            'name.string' => 'The location name must be a string.',
            'name.min' => 'The location name must be at least 2 characters.',
            'name.max' => 'The location name may not be greater than 255 characters.',
            'country.required' => 'The country is required.',
            'country.string' => 'The country must be a string.',
            'country.min' => 'The country must be at least 2 characters.',
            'country.max' => 'The country may not be greater than 255 characters.',
            'region.string' => 'The region must be a string.',
            'region.max' => 'The region may not be greater than 255 characters.',
            'type.required' => 'The location type is required.',
            'type.string' => 'The location type must be a string.',
            'type.in' => 'The location type must be one of: city, region, country.',
            'is_georgian.boolean' => 'The is_georgian field must be true or false.',
            'is_active.boolean' => 'The is_active field must be true or false.',
            'latitude.numeric' => 'The latitude must be a number.',
            'latitude.between' => 'The latitude must be between -90 and 90.',
            'longitude.numeric' => 'The longitude must be a number.',
            'longitude.between' => 'The longitude must be between -180 and 180.',
        ];
    }
}