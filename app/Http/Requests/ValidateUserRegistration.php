<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUserRegistration extends FormRequest
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
            "name" => "required",
            "email" => "required|unique:users",
            "password" => "required|min:8",
            // "role" => "in: admin, petugas, siswa"
        ];

    }

    public function messages() {
        return [
            'name.required' => "Namanya tolong diisi ya bund",
            'email.required' => "Emailnya tolong diisi ya bund",
            'email.unique' => "Emailnya udah ada yang make nich bund",
            'password.required' => "Passwordnya tolong diisi ya bund",
            'password.min' => "Passwordnya minimal 8 karakter yach",
        ];
    }
}
