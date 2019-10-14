<?php

namespace App\Http\Requests;

use App\Email;
use App\Rules\EmpleadoActivo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StoreEmployeeEmail extends FormRequest
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
            'control_number' => [
                'bail', 'required', 'numeric', new EmpleadoActivo,
            ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $num = !empty($this->input('control_number')) ? $this->input('control_number') : 0;
            
            // Valida que el usuario no tenga una cuenta de correo
            $has_email = Email::where('emailable_id', '=', $num)
            ->where('type', '=', 'employee')
            ->count();

            if ($has_email)
            $validator->errors()->add('correo', 'El trabajador ingresado ya posee una cuenta de correo');
        });
    }
}
