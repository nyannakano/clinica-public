<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class servicosFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'ser_name' => 'required',
            'ser_sessions' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'ser_name.required' => 'Nome do serviço é obrigatório',
            'ser_sessions.required' => 'Quantidade de sessões é obrigatório'
        ];
    }
}
