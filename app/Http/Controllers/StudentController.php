<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentEmail;
use App\Student;
use Illuminate\Http\Request;
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
        //$students = Student::all();
        return view('students.index');
    }

    public function getAllStudents()
    {
        $sql = "SELECT FIRST 50 alu.matricula, ap_paterno, ap_materno, alu.nombre, situacion,
        status, gen.telefono, gen.email, gen.curp, car.nombre carrera, uni.nombre unidad, ram.descripcion grado
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

        $sql = "SELECT alu.matricula, ap_paterno, ap_materno, alu.nombre, situacion, status, gen.telefono, gen.email, gen.curp, car.nombre carrera, uni.nombre unidad, ram.descripcion grado
        FROM alumno alu, alumno_general gen, carrera car, unidad uni, rama ram
        WHERE alu.matricula = '$enrollment'
        AND alu.matricula = gen.matricula
        AND alu.carrera_id = car.carrera_id
        AND alu.unidad_id =  uni.unidad_id
        AND car.rama_id = ram.rama_id";
        
        // Busca el estudiante en la DB
        $student = DB::connection('escolares')->select($sql)[0];

        dump($student);

        return view('emails.students.form-create', compact('student'));
    }
}
