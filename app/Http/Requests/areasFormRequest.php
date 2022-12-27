<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class areasFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'area_name' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'area_name.required' => 'Campo nome é obrigatório'
        ];
    }
}
