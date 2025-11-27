<?php

namespace App\Http\Requests\Survey;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSurveyRequest extends FormRequest
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
        'organization_id' => 'nullable|integer',
        'title' => 'nullable|string|max:100|min:3',
        'description' => 'nullable|string|max:250|min:3',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'is_anonymous' => 'nullable|boolean',
    ];
    }

    public function messages(): array{
        return [
            'title.required' => 'Un titre est requis',
            'description.required' => 'Une description est requise',
            'start_date'=> 'Une date de début est requise',
            'end_date'=> 'Une date de fin est requise',
        ];
    }
}
