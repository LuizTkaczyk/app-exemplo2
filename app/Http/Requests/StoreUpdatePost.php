<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //permissão para cadastrar ou editar
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
            // criando uma validação para o titulo
            'title' => 'required|min:3|max:160',
            'content' =>['required', 'min:5', 'max:10000']
        ];
    }
}