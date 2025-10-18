<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtvImageRequest extends FormRequest
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
        return [
            'atv_id' => 'required|exists:atvs,id',
            'url' => 'required|url|max:500',
            'type' => 'required|string|in:image,video',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'integer|min:0',
            'is_primary' => 'boolean',
            'is_active' => 'boolean',
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
            'atv_id.required' => 'The ATV ID is required.',
            'atv_id.exists' => 'The selected ATV does not exist.',
            'url.required' => 'The image/video URL is required.',
            'url.url' => 'The URL must be a valid URL.',
            'url.max' => 'The URL may not be greater than 500 characters.',
            'type.required' => 'The media type is required.',
            'type.in' => 'The media type must be either image or video.',
            'alt_text.max' => 'The alt text may not be greater than 255 characters.',
            'sort_order.integer' => 'The sort order must be an integer.',
            'sort_order.min' => 'The sort order must be at least 0.',
            'is_primary.boolean' => 'The is_primary field must be true or false.',
            'is_active.boolean' => 'The is_active field must be true or false.',
        ];
    }
}