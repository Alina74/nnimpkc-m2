<?php

namespace App\Http\Requests\New;

use Illuminate\Foundation\Http\FormRequest;

class NewCreateValidation extends FormRequest
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
            'header'=>'required',
            'fulldesc'=>'required',
            'abbrdesc'=>'required',
            'tag'=>'required',
            'photo'=>'nullable|max:2048|file|image',
        ];
    }
}
