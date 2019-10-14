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
        // $sql = "SELECT MAX(anio) as anio FROM hdisco";
        // $anio = DB::connection('informix')->select($sql);
        
        // Consigue el número mayor
        // $sql = "SELECT MAX(numero) as numero FROM hdisco WHERE anio = ?";
        // $numero = DB::connection('informix')->select($sql, [$anio[0]->anio]);

        // Consigue los primeros 50 empleados con sus enlaces
        // $sql = "SELECT FIRST 50 hdisco.numconemp, emplea.nombre, emplea.apepat, emplea.apemat, 
        // depend.nombre as dependencia, emplea.curp, emplea.email
        // FROM emplea

        // RIGHT JOIN hdisco ON hdisco.numconemp = emplea.numconemp
        // LEFT JOIN depend ON hdisco.cvedep = depend.clave

        // WHERE hdisco.cvenom = ? AND anio = ? AND numero = ?";

        $sql = "SELECT FIRST 50 hdisco.numconemp, emplea.nombre, emplea.apepat, emplea.apemat, depend.nombre dependencia, emplea.curp, emplea.email
        FROM hdisco, emplea, depend
        WHERE hdisco.numconemp = emplea.numconemp
        AND hdisco.cvedep = depend.clave
        AND hdisco.cvenom = 1
        AND anio = (SELECT MAX(anio) FROM hdisco)
        AND numero = (SELECT MAX(numero) FROM hdisco WHERE anio = (SELECT max(anio) FROM hdisco))";

        $employees = DB::connection('informix')
        ->select($sql);

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
        $data = $request->validated();
        $num_control = $data['control_number'];

        $sql = "SELECT emplea.nombre, emplea.apepat as paterno, emplea.apemat as materno , depend.clave as cvedep,
        depend.nombre as nomdep,emplea.curp, plazas.tipemp, TRIM(tipper.nombre) as tipo_puesto
        from emplea, depend, plazas, tipper
        where emplea.numconemp = 242
        and emplea.numconemp = plazas.numconemp
        and plazas.sitemp = 'VI'
        and plazas.cvedep = depend.clave
        and plazas.tipemp = tipper.clave;";

        $plazas = DB::connection('informix')->select($sql);

        dump($plazas);
        return view('emails.employees.form-create', [ 'num_control' => $num_control, 'plazas' => $plazas ]);
    }
}
