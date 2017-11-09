<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class CountryFormRequest extends FormRequest
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
            'name'          => 'required|min:3|max:100',
            'initials'        => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é de preenchimento obrigatório!',
            //'number.numeric' => 'Precisa ser apenas números!',
            //'number.required' => 'O campo número é de preenchimento obrigatório!',
        ];
    }
}
