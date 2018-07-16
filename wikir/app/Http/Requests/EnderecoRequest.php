<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'logradouro' => 'required|string|max:255',
            'bairro'    => 'required|string|max:20',
            'cep'       => 'required|string|max:14',
            'cidade'    => 'required|string|max:20',
            'uf'        => 'required|string|max:2'

        ];
    }

    public function messages(){
        
        return [
            'logradouro.required' => 'Informe o endereco',
            'bairro.required' => 'Informe o bairro',
            'cep.required' => 'Informe o CEP',
            'cidade' => 'Informe a Cidade',
            'uf.required' => 'Informe a Unidade Federal',
            'uf.max' => 'Informe somente a sigla da Unidade Federal'
        ];
        
    }
}
