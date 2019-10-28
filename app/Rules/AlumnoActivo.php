<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AlumnoActivo implements Rule
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
        $sql = "SELECT alu.matricula, ap_paterno, ap_materno, alu.nombre, situacion, status, gen.telefono, gen.email, gen.curp, car.nombre carrera, uni.nombre unidad, ram.descripcion grado
        FROM alumno alu, alumno_general gen, carrera car, unidad uni, rama ram
        WHERE alu.matricula = '$value'
        AND alu.matricula = gen.matricula
        AND alu.carrera_id = car.carrera_id
        AND alu.unidad_id =  uni.unidad_id
        AND car.rama_id = ram.rama_id";

        // Valida que el usuario exista y esté activo
        $is_student = DB::connection('escolares')->select($sql);
        return count($is_student) > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
