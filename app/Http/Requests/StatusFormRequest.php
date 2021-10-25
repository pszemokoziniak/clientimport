<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusFormRequest extends FormRequest
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
            'status'=>'required',
            'aktywny' => 'numeric'
        ];
    }
    public function messages() {
        return [
            'status.required' => 'Pole Status wymagane',
            'aktywny.numeric' => 'Wybierz czy status jest aktywny'
        ];
    }
}
