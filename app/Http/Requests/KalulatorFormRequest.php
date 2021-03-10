<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KalulatorFormRequest extends FormRequest
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
            'dach'=>'required',
        ];
    }
    public function messages() {
        return [
            'dach.required' => 'Rodzaj Dachu wymagane',
        ];
    }
}
