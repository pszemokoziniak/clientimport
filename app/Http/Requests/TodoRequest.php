<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            'nazwa'=>'required',
            'doKiedy'=>'required',
            'opis'=>'required',
            'nazwa'=>'required',
            'status'=>'required',
            'admin'=>'required',
            'user'=>'required',
        ];
    }
    public function messages() {
        return [
            '*.required' => 'Pole wymagane',
        ];
    }
}
