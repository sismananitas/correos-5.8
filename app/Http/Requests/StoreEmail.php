<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmail extends FormRequest
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
            'login'          => 'required|email|unique:emails,login',
            'password'       => 'required',
            'dependency'     => 'required',
            'status'         => 'required',
            'emailable_id'   => 'required',
            'emailable_type' => 'required',
            'client_name'    => 'required|min:4',
            'delivered_to'   => 'required|min:4',
            'medium'         => 'required|min:4',
            'status'         => 'required|min:4',
        ];
    }
}
