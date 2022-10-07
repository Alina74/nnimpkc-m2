<?php

namespace App\Http\Requests\New;

use Illuminate\Foundation\Http\FormRequest;

class NewCreateValidation extends FormRequest
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
            'header'=>'required',
            'fulldesc'=>'required',
            'abbrdesc'=>'required',
            'tag'=>'required',
            'photo'=>'nullable|max:2048|file|image',
        ];
    }
}
