<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginValidation extends FormRequest
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
            'email'=>'required',
            'password'=>'required',
        ];
    }
}
