<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'sometimes',
            'status' => 'sometimes|numeric:in 1,255',
            'user_name' => 'sometimes',
            'password' => 'sometimes|password',
            'email' => 'sometimes|email',
            'mobile' => 'sometimes|numeric',
            'birth_date' => 'sometimes|date',
            'nationality' => 'sometimes',
            'logo' => 'sometimes',
        ];
    }
}
