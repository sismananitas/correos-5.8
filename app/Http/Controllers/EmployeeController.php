<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\StoreEmployeeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
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
    public function index($page = 1)
    {
        // $regPerPage = 15;
        // $end = $regPerPage * $page;
        // $start = $end - $regPerPage;

        return view('employees.index');
    }

    public function getAllEmployes()
    {
        // Consigue el año mayor
        $sql = "SELECT MAX(anio) as anio FROM hdisco";
        $anio = DB::connection('informix')->select($sql);
        
        // Consigue el número mayor
        $sql = "SELECT MAX(numero) as numero FROM hdisco WHERE anio = ?";
        $numero = DB::connection('informix')->select($sql, [$anio[0]->anio]);

        // Consigue los primeros 50 empleados con sus enlaces
        $sql = "SELECT FIRST 50 emplea.numconemp, emplea.nombre, emplea.apepat, emplea.apemat, 
        depend.nombre as dependencia, emplea.curp, emplea.email
        FROM emplea

        LEFT JOIN depend ON hdisco.cvedep = depend.clave

        WHERE AND anio = ? AND numero = ?";

        $employees = DB::connection('informix')
        ->select($sql, [
            $anio[0]->anio,
            $numero[0]->numero
        ]);

        return response()->json($employees);
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
     * Almacena un correo de tipo empleado
     * 
     * @param \App\Http\Request\StoreEmployeeEmail  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmail(StoreEmployeeEmail $request)
    {
        $data = $request->all();
        
        // Busca el empleado en la DB
        $employee = Employee::where('control_number', '=', $data['control_number'])->first();

        // Crea un Email relacionado al empleado obtenido
        $email = $employee->email()->create([
            'login'        => $data['login'],
            'password'     => $data['password'],
            'delivered_to' => $data['delivered_to'],
            'status'       => $data['status'],
        ]);

        // Crea el registro de la actividad en la entidad Task
        $email->tasks()->create([
            'user_id'     => auth()->user()->id,
            'name'        => 'Se registró un correo de empleado',
            'medium'      => $data['medium'],
            'client_name' => $data['client_name'],
        ]);
        return redirect()->route('correo.index');
    }
}
