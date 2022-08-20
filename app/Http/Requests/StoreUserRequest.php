<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'status' => 'sometimes|numeric:in 1,255',
            'user_name' => 'required',
            'password' => 'required|password',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'birth_date' => 'required|date',
            'nationality' => 'sometimes',
        ];
    }
}
