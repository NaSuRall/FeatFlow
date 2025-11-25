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
        'organization_id' => 'sometimes|integer',
        'title' => 'sometimes|string|max:100|min:3',
        'description' => 'sometimes|string|max:250|min:10',
        'start_date' => 'sometimes|date',
        'end_date' => 'sometimes|date',
        'is_anonymous' => 'sometimes|boolean',
    ];
    }
}
