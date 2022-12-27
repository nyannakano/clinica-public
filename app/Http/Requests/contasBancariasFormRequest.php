<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class contasBancariasFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'con_name' => 'required',
            'con_balance' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'con_name.required' => 'Nome da conta é obrigatório',
            'con_balance.required' => 'Saldo é obrigatório'
        ];
    }
}
