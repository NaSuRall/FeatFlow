<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class AddMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); 
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
        ];
    }
}
