<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeEmail;
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
    public function index()
    {
        $sql = "SELECT FIRST 50 hdisco.numconemp, emplea.nombre, emplea.apepat, emplea.apemat, depend.nombre dependencia, emplea.curp, emplea.email
        FROM hdisco, emplea, depend
        WHERE hdisco.numconemp = emplea.numconemp
        AND hdisco.cvedep = depend.clave
        AND hdisco.cvenom = 1
        AND anio = (SELECT MAX(anio) FROM hdisco)
        AND numero = (SELECT MAX(numero) FROM hdisco WHERE anio = (SELECT max(anio) FROM hdisco))";

        $employees = DB::connection('informix')
        ->select($sql);

        return $employees;
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

        $sql = "SELECT emplea.nombre, emplea.apepat as paterno, emplea.apemat as materno, depend.clave as cvedep,
        depend.nombre as nomdep,emplea.curp, plazas.tipemp, TRIM(tipper.nombre) as tipo_puesto
        from emplea, depend, plazas, tipper
        where emplea.numconemp = ". $data['control_number'] . "
        and emplea.numconemp = plazas.numconemp
        and plazas.sitemp = 'VI'
        and plazas.cvedep = depend.clave
        and plazas.tipemp = tipper.clave;";

        $plazas = DB::connection('informix')->select($sql);

        if (!count($plazas))
        return response()->json(['empleado' => 'Este empleado no tiene plazas activas'], 422);

        return response()->json([ 'num_control' => $num_control, 'plazas' => $plazas, 'empleado' => $plazas[0]]);
    }
}
