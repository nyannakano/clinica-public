<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class meiosPagamentoFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'mei_name' => 'required',
            'mei_indicator' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'mei_name.required' => 'Nome do Meio de Pagamento é obrigatório',
            'mei_indicator' => 'Indicador de pagamento é obrigatório'
        ];
    }
}
