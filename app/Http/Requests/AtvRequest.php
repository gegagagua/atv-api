<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtvRequest extends FormRequest
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
        $atvId = $this->route('atv') ? $this->route('atv')->id : null;

        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'clearance' => 'required|string|max:255',
            'mileage' => 'required|integer|min:0',
            'transmission' => 'required|string|max:255',
            'fuel' => 'required|string|max:255',
            'isActive' => 'boolean',
            'isVip' => 'boolean',
            'engine' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_id' => 'nullable|integer|exists:locations,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'user_id' => 'prohibited', // Prevent user_id from being submitted manually
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
            'name.required' => 'The ATV name is required.',
            'name.max' => 'The ATV name may not be greater than 255 characters.',
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be at least 0.',
            'year.required' => 'The year is required.',
            'year.integer' => 'The year must be an integer.',
            'year.min' => 'The year must be at least 1900.',
            'year.max' => 'The year may not be greater than ' . (date('Y') + 1) . '.',
            'clearance.required' => 'The clearance is required.',
            'clearance.max' => 'The clearance may not be greater than 255 characters.',
            'mileage.required' => 'The mileage is required.',
            'mileage.integer' => 'The mileage must be an integer.',
            'mileage.min' => 'The mileage must be at least 0.',
            'transmission.required' => 'The transmission is required.',
            'transmission.max' => 'The transmission may not be greater than 255 characters.',
            'fuel.required' => 'The fuel type is required.',
            'fuel.max' => 'The fuel type may not be greater than 255 characters.',
            'isActive.boolean' => 'The isActive field must be true or false.',
            'isVip.boolean' => 'The isVip field must be true or false.',
            'engine.required' => 'The engine is required.',
            'engine.max' => 'The engine may not be greater than 255 characters.',
            'description.string' => 'The description must be a string.',
            'location_id.integer' => 'The location ID must be an integer.',
            'location_id.exists' => 'The selected location does not exist.',
            'brand_id.required' => 'The brand is required.',
            'brand_id.integer' => 'The brand ID must be an integer.',
            'brand_id.exists' => 'The selected brand does not exist.',
            'user_id.prohibited' => 'The user ID cannot be set manually.',
        ];
    }
}