<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateValidation extends FormRequest
{
    /**
     * Определение, авторизован ли пользователь для выполнения этого запроса.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Получение правил проверки, применимых к запросу.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullname'=>'required',
            'birthday'=>'required',
            'password'=>'required|min:6|confirmed',
            'email'=>'required',
            'photo_file'=>'nullable|max:2048|file|image',
            'role'=>'required'
        ];
    }
}
