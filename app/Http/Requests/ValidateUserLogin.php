<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUserLogin extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [  
            "username" => "required|unique:petugas",
            "password" => "required"
        ];

    }

    public function messages() {
        return [
            'username.required' => "Usernamenya tolong diisi ya",
            'password.required' => "Passwordnya tolong diisi ya",
        ];
    }
}
