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
            'name' => 'required',
            'status' => 'sometimes|numeric|in:1,255',
            'user_name' => 'required|unique:users,user_name',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
            'birth_date' => 'required|date',
            'nationality' => 'sometimes',
        ];
    }
}
