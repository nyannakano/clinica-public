<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class clientesFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'clie_name' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages(){
        return [
            'clie_name.required' => 'Campo nome é obrigatório',
            'state_id.required' => 'Campo estado é obrigatório',
            'city_id.required' => 'Campo cidade é obrigatório',
        ];
    }
}
