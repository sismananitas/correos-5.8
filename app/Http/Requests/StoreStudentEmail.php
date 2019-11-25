<?php

namespace App\Http\Requests;

use App\Rules\AlumnoActivo;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentEmail extends FormRequest
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
            'enrollment'   => [ 'required', new AlumnoActivo ],
            // 'client_name'  => 'required|min:4',
            // 'delivered_to' => 'required|min:4',
            // 'login'        => 'required|email|unique:emails,login',
            // 'password'     => 'required|min:6',
            // 'medium'       => 'required|min:4',
            // 'status'       => 'required|min:4',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $num = !empty($this->input('enrollment')) ? $this->input('enrollment') : 0;
            
            // Valida que el usuario no tenga una cuenta de correo
            $has_email = Email::where('emailable_id', '=', $num)
            ->where('type', '=', 'student')
            ->count();

            if ($has_email)
            $validator->errors()->add('correo', 'El alumno ingresado ya posee una cuenta de correo');
        });
    }
}
