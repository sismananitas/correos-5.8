<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class EmpleadoActivo implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $sql = "SELECT distinct(hdisco.numconemp), emplea.nombre, emplea.apepat, emplea.apemat, emplea.curp
        FROM hdisco, emplea
        WHERE hdisco.numconemp = " . $value . "
        AND hdisco.cvenom = 1
        AND anio = (SELECT MAX(anio) FROM hdisco)
        AND numero = (SELECT MAX(numero) FROM hdisco WHERE anio = (SELECT max(anio) FROM hdisco))
        AND emplea.numconemp = hdisco.numconemp;";

        // Valida que el usuario exista y esté activo
        $is_employee = DB::connection('informix')->select($sql);
        return count($is_employee) > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El trabajador ingresado no se encuentra activo.';
    }
}
