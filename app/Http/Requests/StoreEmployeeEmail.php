<?php

namespace App\Http\Requests;

use App\Email;
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
            'control_number' => 'required|numeric',
            // 'client_name'    => 'required|min:4',
            // 'delivered_to'   => 'required|min:4',
            // 'login'          => 'required|email|unique:emails,login',
            // 'password'       => 'required|min:6',
            // 'medium'         => 'required|min:4',
            // 'status'         => 'required|min:4',
        ];
    }

    public function withValidator($validator)
    {
        $sql = "SELECT distinct(hdisco.numconemp), emplea.nombre, emplea.apepat, emplea.apemat, emplea.curp
        from hdisco, emplea
        where hdisco.numconemp = " . $this->input('control_number') . "
        AND hdisco.cvenom = 1
        AND anio = (SELECT MAX(anio) FROM hdisco)
        AND numero = (SELECT MAX(numero) FROM hdisco WHERE anio = (SELECT max(anio) FROM hdisco))
        AND emplea.numconemp = hdisco.numconemp;";

        $is_employee = DB::connection('informix')->select($sql);

        $validator->after(function ($validator) use ($is_employee) {
            if (count($is_employee) <= 0)
            $validator->errors()->add('emplea', 'El trabajador ingresado no se encuentra activo');
            
            $has_email = Email::where('emailable_id', '=', $this->input('control_number'))->count();

            if ($has_email)
            $validator->errors()->add('correo', 'El trabajador ingresado ya posee una cuenta de correo');
        });
    }
}
