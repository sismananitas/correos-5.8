<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;
use App\Student;
use App\Employee;
use App\Http\Requests\StoreEmail;

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
        $students = Student::all();
        $employees = Employee::all();

        return view('emails.index', [
            'emails'    => $emails,
            'students'  => $students,
            'employees' => $employees,
        ]);
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
    public function store(StoreEmail $request)
    {
        $data = $request->validated();

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

        return response()->json([ 'success' => 'Correo creado exitosamente', 'email' => $email->login ]);
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
        $request->validate([
            'login'    => 'required|email|unique:emails',
            'password' => 'required',
        ]);
        return $request->all();
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
}
