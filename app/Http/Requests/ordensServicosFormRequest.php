<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ordensServicosFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'cli_id' => 'required',
            'pro_id' => 'required',
            'ser_id' => 'required',
            'ord_sessions' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'cli_id.required' => 'Cliente é obrigatório',
            'ser_id.required' => 'Serviço é obrigatório',
            'ord_sessions' => 'Quantidade de sessões é obrigatório'
        ];
    }
}
