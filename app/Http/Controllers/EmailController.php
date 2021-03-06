<?php

namespace App\Http\Controllers;

use App\Task;
use App\Email;
use App\Student;
use App\Employee;
use App\Http\Requests\StoreEmail;
use App\Http\Requests\UpdateEmail;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
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
        $emails = Email::all();
        return $emails;
    }
    
    public function page()
    {
        $emails = Email::all();
        $students = Student::all();
        $employees = Employee::all();

        return view('emails.index2', [
            'emails'    => $emails,
            'students'  => $students,
            'employees' => $employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmail $request)
    {
        $data = $request->validated();

        if ($data['emailable_type'] == 'departament') {
            DB::table('departament')->insert([
                null, $data['name'], $data['lasname'], $data['dependency']
            ]);
        }

        if ($data['emailable_type'] == 'other') {
            DB::table('others')->insert([
                null, $data['name'], $data['lastname']
            ]);
        }

        $email = new Email();
        $email->login          = $data['login'];
        $email->password       = $data['password'];
        $email->dependency     = $data['dependency'];
        $email->delivered_to   = $data['delivered_to'];
        $email->type           = $data['emailable_type'];
        $email->status         = $data['status'];
        $email->emailable_id   = $data['emailable_id'];
        $email->emailable_type = $data['emailable_type'];
        $email->save();

        // Crea un registro de la tarea realizada
        $email->tasks()->create([
            'user_id'     => auth()->user()->id,
            'name'        => 'Registró un correo',
            'medium'      => $data['medium'],
            'client_name' => $data['client_name'],
        ]);
        
        return response()->json(['success' => 'Correo ' . $email->login . ' creado exitosamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        return $email;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email, $emailable = '')
    {
        switch ($email->type) {
            case 'employee':
                $emailable = $this->getEmployee($email->emailable_id);
            break;
        }
        return view('emails.edit', compact('correo', 'emailable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmail $request, Email $email)
    {
        $data = $request->validated();

        $task = new Task();
        $task->client_name = $data['solicitante'];
        $task->email_id    = $email->id;
        $task->user_id     = auth()->user()->id;
        $task->name        = 'Actualización del correo ' . $email->login;
        $task->medium      = $data['medium'];
        $task->save();

        $email->login    = $data['login'];
        $email->password = $data['password'];
        $email->status   = $data['status'];
        $email->save();

        return response()->json(['success' => 'Correo actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        // TODO: Softdelete
        $email->delete();
        return response()
        ->json(['success' => 'El correo ha sido eliminado correctamente']);
    }

    private function getEmployee($control_number)
    {
        $sql = "SELECT distinct(hdisco.numconemp), emplea.nombre, emplea.apepat, emplea.apemat, emplea.curp
        FROM hdisco, emplea
        WHERE hdisco.numconemp = $control_number
        AND hdisco.cvenom = 1
        AND anio = (SELECT MAX(anio) FROM hdisco)
        AND numero = (SELECT MAX(numero) FROM hdisco WHERE anio = (SELECT max(anio) FROM hdisco))
        AND emplea.numconemp = hdisco.numconemp;";

        $employee = DB::connection('informix')->select($sql);
        return $employee[0];
    }
}