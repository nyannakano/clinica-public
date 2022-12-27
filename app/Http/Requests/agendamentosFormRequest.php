<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class agendamentosFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'title.required' => 'Nome é obrigatório'
        ];
    }
}
