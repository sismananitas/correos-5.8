<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOtherEmail;
use App\Other;
use Illuminate\Http\Request;

class OtherController extends Controller
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
        //
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
     * Almacena un Email de tipo Other en la DB
     * 
     * @param \App\Http\Requests\StoreOtherEmail
     * @return \Illuminate\Http\Response
     */
    public function storeEmail(StoreOtherEmail $request)
    {
        $data = $request->all();
        
        // Crea un registro con sus datos en la DB
        $Other = new Other();
        $Other->name = $data['name'];
        $Other->lastname = $data['lastname'];
        $Other->save();

        // Crea el Email relacionado con el usuario registrado
        $email = $Other->email()->create([
            'login'        => $data['login'],
            'password'     => $data['password'],
            'delivered_to' => $data['delivered_to'],
            'status'       => $data['status'],
        ]);

        // Crea un registro de la tarea realizada
        $email->tasks()->create([
            'user_id'     => auth()->user()->id,
            'name'        => 'Se registró un correo de tipo otros',
            'medium'      => $data['medium'],
            'client_name' => $data['client_name'],
        ]);
        return redirect()->route('correo.index');
    }
}
