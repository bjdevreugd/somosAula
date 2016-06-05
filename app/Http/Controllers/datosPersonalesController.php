<?php

namespace somosAula\Http\Controllers;

use Illuminate\Http\Request;

use somosAula\Colegio;
use somosAula\Http\Requests;
use somosAula\Http\Controllers\Controller;
use somosAula\User;
use somosAula\userRol;
use somosAula\datosPersonales;
use Validator;
use Auth;
use Hash;

class datosPersonalesController extends Controller
{
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function datospersonales()
    {
        return view('users.datospersonales');
    }


    public function postDatosPersonales(Request $request)
    {

        $rules = [

            'nombre_col' => 'min:3|max:50|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'name' => 'required|min:3|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'secondname' => 'required|min:3|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'secondname2' => 'required|min:3|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'email|max:255',
            'DNI' => 'required|min:9|max:9',
            'telefono' => 'min:9|max:16',
            'fechanacimiento' => 'required|date',
        ];

        $messages = [
            'nombre_col.min' => 'El mínimo de caracteres permitidos son 3',
            'nombre_col.max' => 'El máximo de caracteres permitidos son 50',
            'nombre_col.regex' => 'Sólo se aceptan letras',
            'name.min' => 'El mínimo de caracteres permitidos son 3',
            'name.max' => 'El máximo de caracteres permitidos son 16',
            'name.regex' => 'Sólo se aceptan letras',
            'secondname.min' => 'El mínimo de caracteres permitidos son 3',
            'secondname.max' => 'El máximo de caracteres permitidos son 16',
            'secondname.regex' => 'Sólo se aceptan letras',
            'secondname2.min' => 'El mínimo de caracteres permitidos son 3',
            'secondname2.max' => 'El máximo de caracteres permitidos son 16',
            'secondname2.regex' => 'Sólo se aceptan letras',
            'DNI.min' => 'El mínimo de caracteres permitidos son 9',
            'DNI.max' => 'El máximo de caracteres permitidos son 9',
            'DNI.unique' => 'El email ya existe',
            'email.email' => 'El formato de email es incorrecto',
            'email.max' => 'El máximo de caracteres permitidos son 255',
            'email.unique' => 'El email ya existe',
            'fechanacimiento.date' => 'El formato de date es incorrecto',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("users/datospersonales")
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error al introducir sus datos');;
        } else {
            $datosPersonales = new datosPersonales;
            $colegio = new Colegio;
            $userRol = new userRol;
            $user = new User;
            $the_user = $user->select()->where('email', '=', $request->email)->get();
            $the_userol = $userRol->select()->where('user_id', '=', $the_user[0]['id'])->get();
            $the_colegio = $colegio->select()->where('user_rol_id', '=', $the_userol[0]['id'])->get();
            $colegio->where('id', '=', $the_colegio[0]['id'])
                ->update(['nombre' => $request->nombre_col]);
            $datosPersonales->name = $request->name;
            $datosPersonales->email = $request->email;
            $data['secondname'] = $datosPersonales->secondname = $request->secondname;
            $data['secondname2'] = $datosPersonales->secondname2 = $request->secondname2;
            $data['DNI'] = $datosPersonales->DNI = $request->DNI;
            $data['telefono'] = $datosPersonales->telefono = $request->telefono;
            $data['fechanacimiento'] = $datosPersonales->fechanacimiento = $request->fechanacimiento;
            $data['user_id'] = $datosPersonales->user_id = $the_user[0]['id'];
            $datosPersonales->save();

            return redirect("/")
                ->with("info", "Gracias por rellenar con sus datos personales, ya puede iniciar sesión");
        }


    }

    /*public function updatedatosper()
    {
        return View('users.updatedatospersonales');
    }*/


    public function updatedatospersonales(Request $request)
    {
        $rules = [

            'nombre_col' => 'required|min:3|max:50|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'name' => 'required|min:3|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'secondname' => 'required|min:3|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'secondname2' => 'required|min:3|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255',
            'DNI' => 'required|min:9|max:9',
            'telefono' => 'required|min:9|max:16',
            'fechanacimiento' => 'required|date',
        ];

        $messages = [
            'nombre_col.min' => 'El mínimo de caracteres permitidos son 3',
            'nombre_col.max' => 'El máximo de caracteres permitidos son 50',
            'nombre_col.regex' => 'Sólo se aceptan letras',
            'name.min' => 'El mínimo de caracteres permitidos son 3',
            'name.max' => 'El máximo de caracteres permitidos son 16',
            'name.regex' => 'Sólo se aceptan letras',
            'secondname.min' => 'El mínimo de caracteres permitidos son 3',
            'secondname.max' => 'El máximo de caracteres permitidos son 16',
            'secondname.regex' => 'Sólo se aceptan letras',
            'secondname2.min' => 'El mínimo de caracteres permitidos son 3',
            'secondname2.max' => 'El máximo de caracteres permitidos son 16',
            'secondname2.regex' => 'Sólo se aceptan letras',
            'DNI.min' => 'El mínimo de caracteres permitidos son 9',
            'DNI.max' => 'El máximo de caracteres permitidos son 9',
            'DNI.unique' => 'El email ya existe',
            'email.email' => 'El formato de email es incorrecto',
            'email.max' => 'El máximo de caracteres permitidos son 255',
            'email.unique' => 'El email ya existe',
            'fechanacimiento.date' => 'El formato de date es incorrecto',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("user/panel")
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error al introducir sus datos');;
        } else {

            $datosPersonales = new datosPersonales;
            $colegio = new Colegio;
            $userRol = new userRol;
            $user = new User;

            $the_user = $user->select()->where('email', '=', $request->email)->get();
            $the_userol = $userRol->select()->where('user_id', '=', $the_user[0]['id'])->get();
            $the_colegio = $colegio->select()->where('user_rol_id', '=', $the_userol[0]['id'])->get();

            $colegio->where('id', '=', $the_colegio[0]['id'])
                ->update(['nombre' => $request->nombre_col]);

            $datosPersonales->where('user_id', '=', \Auth::user()->id)
                ->update(['name' => $request->name,
                    'secondname' => $request->secondname,
                    'secondname2' => $request->secondname2,
                    'email' => $request->email,
                    'DNI' => $request->DNI,
                    'telefono' => $request->telefono,
                    'fechanacimiento' => $request->fechanacimiento]
            );


            return redirect("user/panel")
                ->with("success", "Actualización realizada con exito");
        }
    }

}
