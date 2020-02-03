<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentEmail;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = "SELECT FIRST 50
        alu.matricula, ap_paterno, ap_materno, alu.nombre, situacion, status, gen.telefono,
        gen.email, gen.curp, car.nombre carrera, uni.nombre unidad, ram.descripcion grado
        FROM alumno alu, alumno_general gen, carrera car, unidad uni, rama ram
        WHERE alu.matricula = gen.matricula
        AND alu.carrera_id = car.carrera_id
        AND alu.unidad_id =  uni.unidad_id
        AND car.rama_id = ram.rama_id";

        $students = DB::connection('escolares')
        ->select($sql);
        return response()->json($students);
    }

    /**
     * Almacena un Email de tipo Student en la DB
     * 
     * @param \App\Http\Requests\StoreStudentEmail
     * @return \Illuminate\Http\Response
     */
    public function storeEmail(StoreStudentEmail $request)
    {
        $data = $request->validated();
        $enrollment = $data['enrollment'];

        $sql = "SELECT alu.matricula, ap_paterno, ap_materno, alu.nombre, situacion, status,
        gen.telefono, gen.email, gen.curp, car.nombre carrera, uni.nombre unidad, ram.descripcion grado
        FROM alumno alu, alumno_general gen, carrera car, unidad uni, rama ram
        WHERE alu.matricula = '$enrollment'
        AND alu.matricula = gen.matricula
        AND alu.carrera_id = car.carrera_id
        AND alu.unidad_id =  uni.unidad_id
        AND car.rama_id = ram.rama_id";
        
        // Busca el estudiante en la DB
        $student = DB::connection('escolares')->select($sql)[0];
        return $student;
    }
}
