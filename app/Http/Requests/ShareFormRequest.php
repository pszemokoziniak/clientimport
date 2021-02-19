<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ShareFormRequest extends FormRequest
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
        $req = $this->all();
        $req['nrtelefonu'] = str_replace(' ', '', $req['nrtelefonu']);
        // $this->replace($req);
        // $req = array_map('trim', $this->all());
        // $nrtelefonu = $req['nrtelefonu'];
        // dd($req);
        
        return [
            'nazwa'=>'required',
            'email'=> 'email|nullable',
            'nrtelefonu'=>'min:9|max:9|required|numeric',
            'handlowiec' => 'numeric'
        ];
    }
    public function messages() {
        return [
            'nazwa.required' => 'Pole nazwa wymagane',
            'email.email' => 'Zły format email',
            'nrtelefonu.min' => 'Numer telefonu musi mieć 9 cyfr',
            'nrtelefonu.max' => 'Numer telefonu musi mieć 9 cyfr',
            'handlowiec.numeric' => 'Wybierz handlowca',
            'nrtelefonu.numeric' => 'Numer telefonu może składać się tylko z cyfr'
        ];
    }
}
