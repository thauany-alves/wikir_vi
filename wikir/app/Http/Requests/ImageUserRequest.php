<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageUserRequest extends FormRequest
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
    
    public function rules()
    {
        return [
            'img_user' => 'image',

        ];
    }

    public function messages(){
        
        return [
            'img_user.image' => 'O arquivo necessita está em formato de imagem'
        ];
        
    }
}
