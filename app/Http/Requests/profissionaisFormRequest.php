<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profissionaisFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'pro_name' => 'required',
            'area_id' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'pro_name.required' => 'Campo nome é obrigatório',
            'area_id.required' => 'Campo área é obrigatório'
        ];
    }
}
