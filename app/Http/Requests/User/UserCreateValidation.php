<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateValidation extends FormRequest
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
            'fullname'=>'required',
            'birthday'=>'required',
            'password'=>'required|min:6|confirmed',
            'email'=>'required|unique:users',
            'photo_file'=>'nullable|max:2048|file|image',
            'role'=>'required'
        ];
    }
}