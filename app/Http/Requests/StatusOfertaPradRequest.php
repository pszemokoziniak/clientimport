<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusOfertaPradRequest extends FormRequest
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
            'statusoferta'=>'required',
        ];
    }
    public function messages() {
        return [
            'statusoferta.required' => 'Pole status wymagane',
        ];
    }
}
