<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    private $rules;

    public function __construct()
    {
        $this->middleware('auth');
        $this->rules = [
            'search'    => 'required|string',
            'field'     => 'required',
            'category'  => 'required',
            'results'   => 'required|numeric'
        ];
    }

    public function index()
    {
        return view('reportes.index');
    }

    public function trabajadores(Request $request)
    {
        $request->validate($this->rules);

        $data  = $request->all();
        $field = str_replace('_', '.', $data['field']);
        $value = strtoupper($data['search']);
        $results = $data['results'];

        $sql = "SELECT FIRST $results emplea.nombre, emplea.apepat as paterno, emplea.apemat as materno, depend.clave as cvedep,
        depend.nombre as nomdep, emplea.curp, plazas.tipemp, TRIM(tipper.nombre) as tipo_puesto
        FROM emplea, depend, plazas, tipper
        WHERE emplea.numconemp = plazas.numconemp
        AND plazas.sitemp = 'VI'
        AND plazas.cvedep = depend.clave
        AND plazas.tipemp = tipper.clave
        AND " . $field . " = '" . $value . "';";

        // $sql = "SELECT emplea.nombre, emplea.apepat as paterno, emplea.apemat as materno, depend.clave as cvedep,
        // depend.nombre as nomdep,emplea.curp, plazas.tipemp, TRIM(tipper.nombre) as tipo_puesto
        // FROM emplea, depend, plazas, tipper
        // WHERE emplea.numconemp = ". $data['control_number'] . "
        // AND emplea.numconemp = plazas.numconemp
        // AND plazas.sitemp = 'VI'
        // AND plazas.cvedep = depend.clave
        // AND plazas.tipemp = tipper.clave;";

        $plazas = DB::connection('informix')->select($sql);
        return response()->json(['type' => 'empleados', 'data' => $plazas]);
    }

    public function alumnos(Request $request)
    {
        $request->validate($this->rules);

        $data    = $request->all();
        $field   = str_replace('_', '.', $data['field']);
        $value   = strtoupper($data['search']);
        $results = $data['results'];

        $sql = "SELECT FIRST $results alu.matricula, ap_paterno, ap_materno, alu.nombre,
        situacion, status, gen.telefono, gen.email, gen.curp, car.nombre carrera,
        uni.nombre unidad, ram.descripcion grado
        FROM alumno alu, alumno_general gen, carrera car, unidad uni, rama ram
        WHERE alu.carrera_id = car.carrera_id
        AND alu.unidad_id    =  uni.unidad_id
        AND car.rama_id      = ram.rama_id
        AND " . $field . " = '" . $value . "';";

        $students = DB::connection('escolares')
        ->select($sql);

        // $sql = "SELECT FIRST 50 alu.matricula, ap_paterno, ap_materno, alu.nombre, situacion,
        // status, gen.telefono, gen.email, gen.curp, car.nombre carrera, uni.nombre unidad, ram.descripcion grado
        // FROM alumno alu, alumno_general gen, carrera car, unidad uni, rama ram
        // WHERE alu.matricula = gen.matricula
        // AND alu.carrera_id = car.carrera_id
        // AND alu.unidad_id =  uni.unidad_id
        // AND car.rama_id = ram.rama_id";
        
        return response()->json(['type' => 'alumnos', 'data' => $students]);
    }

    public function emails(Request $request)
    {
        $request->validate($this->rules);
        $data = $request->all();

        
        return response()->json($data);
    }
}
