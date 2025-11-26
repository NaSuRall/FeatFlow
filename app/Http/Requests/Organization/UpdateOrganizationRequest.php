<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

<<<<<<< HEAD
<<<<<<<< HEAD:app/Http/Requests/Organization/UpdateOrganizationRequest.php
class UpdateOrganizationRequest extends FormRequest
========
class DeleteOrganizationRequest extends FormRequest
>>>>>>>> 9f3a0d0e0a385c35274ac62a834d86085276bf00:app/Http/Requests/Organization/DeleteOrganizationRequest.php
=======
<<<<<<<< HEAD:app/Http/Requests/Organization/StoreOrganizationRequest.php
class StoreOrganizationRequest extends FormRequest
========
class UpdateOrganizationRequest extends FormRequest
>>>>>>>> 9f3a0d0e0a385c35274ac62a834d86085276bf00:app/Http/Requests/Organization/UpdateOrganizationRequest.php
>>>>>>> 9f3a0d0e0a385c35274ac62a834d86085276bf00
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
<<<<<<< HEAD
         $organization = $this->route('organization');
        return $organization && $organization->user_id === $this->user()->id;
=======
<<<<<<<< HEAD:app/Http/Requests/Organization/StoreOrganizationRequest.php
        return auth()->check();
========
        $organization = $this->route('organization');
        return $organization && $organization->user_id === $this->user()->id;
>>>>>>>> 9f3a0d0e0a385c35274ac62a834d86085276bf00:app/Http/Requests/Organization/UpdateOrganizationRequest.php
>>>>>>> 9f3a0d0e0a385c35274ac62a834d86085276bf00
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
<<<<<<< HEAD
        return [
            //
        ];
    }
=======
        $organizationId = $this->route('organization')->id;

        return [
<<<<<<<< HEAD:app/Http/Requests/Organization/StoreOrganizationRequest.php
            'name' => 'required|string|max:255|unique:organizations,name',  
========
            'name' => 'required|string|max:255|unique:organizations,name,' . $organizationId,
>>>>>>>> 9f3a0d0e0a385c35274ac62a834d86085276bf00:app/Http/Requests/Organization/UpdateOrganizationRequest.php
        ];
    }


>>>>>>> 9f3a0d0e0a385c35274ac62a834d86085276bf00
}
