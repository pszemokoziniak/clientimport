<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfertaFormRequest extends FormRequest
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
            'cenaNetto'=>'required',
            'vat'=>'numeric|required',
            'cenaBrutto'=>'required',
            'email'=> 'email|required'
        ];
    }
    public function messages() {
        return [
            '*.required' => 'Pole wymagane',
            'email.email' => 'Zły format email',
            'vat.numeric' => 'Pole wymagane'
        ];
    }
}
