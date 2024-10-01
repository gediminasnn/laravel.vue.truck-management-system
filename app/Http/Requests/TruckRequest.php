<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TruckRequest extends FormRequest
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
            'unit_number' => [
                'required',
                'string',
                'max:255',
            ],
            'year' => [
                'required',
                'integer',
                'min:1900',
                'max:' . (date('Y') + 5),
            ],
            'notes' => 'nullable|string',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'unit_number' => 'unit number',
            'year' => 'year',
            'notes' => 'notes',
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'year.min' => 'Year must be no earlier than 1900.',
            'year.max' => 'Year must not be later than 5 years from now.',
        ];
    }
}
