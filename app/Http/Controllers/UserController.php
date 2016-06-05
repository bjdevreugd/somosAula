<?php

namespace somosAula\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\ViewErrorBag;
use somosAula\Colegio;
use somosAula\Http\Requests;
use somosAula\Http\Controllers\Controller;
use somosAula\Rol;
use somosAula\User;
use somosAula\userRol;
use somosAula\datosPersonales;
use Validator;
use Auth;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     * public function index()
     * {
     * //
     * }
     *
     * /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     * public function create()
     * {
     * return view('users.create');
     * }
     *
     * /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * public function store(Request $request)
     * {
     * $this->validate($request, User::$create_validation_rules);
     * $data = $request -> only('name', 'email', 'password');
     * $data['password'] = bcrypt($data['password']);
     * $user = User::create($data);
     * if($user){
     * \Auth::login($user);
     * return redirect()->route('inicio');
     * }
     * return back()->withInput();
     * }
     *
     * /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     * public function show($id)
     * {
     * //
     * }
     *
     * /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     * public function edit($id)
     * {
     * //
     * }
     *
     * /**
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
     *
     * public function destroy($id)
     * {
     * //
     * }
     *
     * public function inicio()
     * {
     * return view('index');
     * }*/

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user()
    {

        return View('users.user');
    }

    public function userPanel()
    {


        return View('users.userpanel');
    }

    public function imgperfil()
    {
        return View('users.imgperfil');
    }

    public function updateImgProfile(Request $request)
    {
        $rules = ['image' => 'required|image|max:1024*1024*1'];
        $messages = [
            'image.required' => 'La imagen es requerida',
            'image.image' => 'Formato no permitido',
            'image.max' => 'El máximo permitido es 1 MB',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('users/imgperfil')->withErrors($validator);
        } else {
            $name = str_random(30) . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('perfiles', $name);
            $user = new User();
            $user->where('id', '=', \Auth::user()->id)
                ->update(['imgperfil' => 'perfiles/' . $name]);
            return redirect('user')->with('success', 'Su imagen de perfil ha sido cambiada con éxito');
        }
    }

    public function password()
    {

        return View('users.password');

    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'mypassword' => 'required',
            'password' => 'required|confirmed|min:6|max:18',
        ];

        $messages = [
            'mypassword.required' => 'El campo es requerido',
            'password.required' => 'El campo es requerido',
            'password.confirmed' => 'Los passwords no coinciden',
            'password.min' => 'El mínimo permitido son 6 caracteres',
            'password.max' => 'El máximo permitido son 18 caracteres',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('users/password')->withErrors($validator);
        } else {
            if (Hash::check($request->mypassword, Auth::user()->password)) {
                $user = new User;
                $user->where('email', '=', \Auth::user()->email)
                    ->update(['password' => bcrypt($request->password)]);
                return redirect('user')->with('status', 'Password cambiado con éxito');
            } else {
                return redirect('users/password')->with('message', 'Credenciales incorrectas');
            }
        }
    }

}
