<?php
/*
namespace somosAula\Http\Controllers;

use Illuminate\Http\Request;

use somosAula\Http\Requests;
use somosAula\Http\Controllers\Controller;
use somosAula\User;
class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function logout(){
     \Auth::logout();
        return view('index');
    }

    public function handleLogin(Request $request){
$this->validate($request, User::$login_validation_rules);
        $data = $request->only('email','password');
    if(\Auth::attempt($data)){
        return redirect()->intended('inicio');
    }
        return back()->withInput();
    }

     }*/

namespace somosAula\Http\Controllers;

use Illuminate\Http\Request;

use somosAula\datosPersonales;
use somosAula\Http\Requests;
use somosAula\tutorlegal_hijo;
use Validator;
use somosAula\Http\Controllers\Controller;
use somosAula\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Mail;
use Auth;
use somosAula\Colegio;
use somosAula\Rol;
use somosAula\userRol;
use DB;

class AuthController extends Controller
{
    protected $redirectPath = '/user';

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    use AuthenticatesAndRegistersUsers;


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function postRegister(Request $request)
    {

        $rules = [
            'name' => 'required|min:3|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:18|confirmed',
        ];

        $messages = [
            'name.required' => 'El campo es requerido',
            'name.min' => 'El mínimo de caracteres permitidos son 3',
            'name.max' => 'El máximo de caracteres permitidos son 16',
            'name.regex' => 'Sólo se aceptan letras',
            'email.required' => 'El campo es requerido',
            'email.email' => 'El formato de email es incorrecto',
            'email.max' => 'El máximo de caracteres permitidos son 255',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El campo es requerido',
            'password.min' => 'El mínimo de caracteres permitidos son 6',
            'password.max' => 'El máximo de caracteres permitidos son 18',
            'password.confirmed' => 'Los passwords no coinciden',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("/")
                ->withErrors($validator)
                ->withInput()
                ->with('error', '');;
        } else {
            $user = new User;
            $data['name'] = $user->name = $request->name;
            $data['email'] = $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->remember_token = str_random(100);
            $data['confirm_token'] = $user->confirm_token = str_random(100);
            $user->save();

            Mail::send('emails.register', ['data' => $data], function ($mail) use ($data) {
                $mail->subject('Confirma tu cuenta en somosAula');
                $mail->sender('bj.devreugd@gmail.com');
                $mail->to($data['email'], $data['name']);
            });

            return redirect("/")
                ->with("info", "Confirme su cuenta mediante el enlace enviado a su email");
        }


    }

    public function confirmRegister($email, $confirm_token)
    {
        $user = new User;
        global $the_user;
        global $the_colegio;
        global $the_userRol;
        $the_user = $user->select()->where('email', '=', $email)
            ->where('confirm_token', '=', $confirm_token)->get();

        $rol = new Rol;
        $user_rol = new userRol;
        $user_rol->rol_id = $rol->id = 2;
        $user_rol->user_id = $the_user[0]['id'];
        $user_rol->save();

        $the_userRol = $user_rol->select()->where('user_id', '=', $the_user[0]['id'])->get();
        $colegio = new Colegio;
        $colegio->cod_aula = str_random(5);
        $colegio->user_rol_id = $the_userRol[0]['id'];
        $colegio->save();


        $the_colegio = $colegio->select()->where('user_rol_id', '=', $the_userRol[0]['id'])->get();
        if (count($the_user) > 0) {
            $active = 1;
            $confirm_token = str_random(100);
            $user->where('email', '=', $email)
                ->update(['active' => $active, 'confirm_token' => $confirm_token]);

            Mail::raw('He aquí su codigo de aula:' . $the_colegio[0]['cod_aula'] . '', function ($message) {
                global $the_user;
                $message->from('bj.devreugd@gmail.com');
                $message->subject('somosAula codigo de aula');
                $message->to('' . $the_user[0]['email'] . '');
            });

            return redirect('users/datospersonales')
                ->with('');

        } else {
            return redirect('');
        }

    }

    public function confirmRegAlumno($email, $confirm_token)
    {
        $user = new User;
        global $the_user;
        $the_user = $user->select()->where('email', '=', $email)
            ->where('confirm_token', '=', $confirm_token)->get();

        if (count($the_user) > 0) {
            $active = 1;
            $confirm_token = str_random(100);
            $user->where('email', '=', $email)
                ->update(['active' => $active, 'confirm_token' => $confirm_token]);

            return redirect('users/datospersonales')
                ->with('');

        } else {
            return redirect('');
        }

    }

    public function postLogin(Request $request)
    {

        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password,
                'active' => 1
            ]
            , $request->has('remember')
        )
        ) {
            return redirect()->intended('user');
        } else {
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];

            $messages = [
                'email.required' => 'El campo email es requerido',
                'email.email' => 'El formato de email es incorrecto',
                'password.required' => 'El campo password es requerido',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            return redirect('/')
                ->withErrors($validator)
                ->withInput()
                ->with('error', '');
        }
    }

    public function postRegisterAlumno(Request $request)
    {

        $rules = [
            'name' => 'required|min:3|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:18|confirmed',
            'cod_aula' => 'required|min:5|max:5|exists:colegio',
        ];

        $messages = [
            'name.required' => 'El campo es requerido',
            'name.min' => 'El mínimo de caracteres permitidos son 3',
            'name.max' => 'El máximo de caracteres permitidos son 16',
            'name.regex' => 'Sólo se aceptan letras',
            'email.email' => 'El formato de email es incorrecto',
            'email.max' => 'El máximo de caracteres permitidos son 255',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El campo es requerido',
            'password.min' => 'El mínimo de caracteres permitidos son 6',
            'password.max' => 'El máximo de caracteres permitidos son 18',
            'password.confirmed' => 'Los passwords no coinciden',
            'cod_aulaa.required' => 'El campo es requerido',
            'cod_aula.min' => 'El mínimo de caracteres permitidos son 5',
            'cod_aula.max' => 'El máximo de caracteres permitidos son 5',
            'cod_aula.exists' => 'Solicite el codigo a su profesor',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("/")
                ->withErrors($validator)
                ->withInput()
                ->with('error', '');
        } else {
            $user = new User;
            $data['name'] = $user->name = $request->name;
            $data['email'] = $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->remember_token = str_random(100);
            $data['confirm_token'] = $user->confirm_token = str_random(100);
            $user->save();

            $the_user = $user->select()->where('email', '=', $data['email']);

            $rol = new Rol;
            $user_rol = new userRol;
            $user_rol->rol_id = $rol->id = 3;
            $user_rol->user_id = $user->id;
            $user_rol->save();

            $the_userRol = $user_rol->select()->where('user_id', '=', $user->id)->get();

            $colegio = new colegio;
            $colegio->cod_aula = $request->cod_aula;
            $colegio->user_rol_id = $the_userRol[0]['id'];
            $colegio->save();
            global $codMailProfe;
            $codMailProfe = Colegio::select()
                ->join('user_rol', 'colegio.user_rol_id', '=', 'user_rol.id')
                ->join('rol', 'user_rol.rol_id', '=', 'rol.id')
                ->join('datos_personales', 'user_rol.user_id', '=', 'datos_personales.user_id')
                ->where('colegio.cod_aula', '=', $request->cod_aula)
                ->where('rol.tipo', '=', 'profesor')->get();

            Mail::send('emails.regalum', ['data' => $data], function ($mail) use ($data) {
                global $codMailProfe;
                $mail->subject('Confirma tu cuenta en somosAula');
                $mail->sender('bj.devreugd@gmail.com');
                $mail->to(''.$codMailProfe[0]['email'].'', $data['name']);
            });

            return redirect("/")
                ->with("info", "Confirme su cuenta mediante el enlace enviado a su email");
        }




    }

    public function postRegisterPadre(Request $request)
    {

        $rules = [
            'name' => 'required|min:3|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:18|confirmed',
            'dni_hijo' => 'required',
        ];

        $messages = [
            'name.required' => 'El campo es requerido',
            'name.min' => 'El mínimo de caracteres permitidos son 3',
            'name.max' => 'El máximo de caracteres permitidos son 16',
            'name.regex' => 'Sólo se aceptan letras',
            'email.email' => 'El formato de email es incorrecto',
            'email.max' => 'El máximo de caracteres permitidos son 255',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El campo es requerido',
            'password.min' => 'El mínimo de caracteres permitidos son 6',
            'password.max' => 'El máximo de caracteres permitidos son 18',
            'password.confirmed' => 'Los passwords no coinciden',
            'dni_hijo.required' => 'El campo es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("/")
                ->withErrors($validator)
                ->withInput()
                ->with('error', '');
        } else {
            $user = new User;
            $data['name'] = $user->name = $request->name;
            $data['email'] = $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->remember_token = str_random(100);
            $data['confirm_token'] = $user->confirm_token = str_random(100);
            $user->save();

            $rol = new Rol;
            $user_rol = new userRol;
            $user_rol->rol_id = $rol->id = 4;
            $user_rol->user_id = $user->id;
            $user_rol->save();

            $hijo = datosPersonales::select()
                ->where('datos_personales.DNI', '=', $request->dni_hijo)->get();

            $the_tutor = $user_rol->select()->where('user_id','=',$user->id)->get();
            $the_hijo = $user_rol->select()->where('user_id', '=', $hijo[0]['user_id'])->get();
            $tutor_hijo = new tutorlegal_hijo;
            $tutor_hijo->hijo_id = $the_hijo[0]['id'];
            $tutor_hijo->tutor_id = $the_tutor[0]['id'];
            $tutor_hijo->save();

            Mail::send('emails.regPadre', ['data' => $data], function ($mail) use ($data) {
                $mail->subject('Confirma tu cuenta en somosAula');
                $mail->sender('bj.devreugd@gmail.com');
                $mail->to($data['email'], $data['name']);
            });

            return redirect("/")
                ->with("success", "Confirme su cuenta mediante el enlace enviado a su email");
        }
    }


        /*  public function postDatosP(Request $request)
          {

              $rules = [
                  'name' => 'required|min:3|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
                  'email' => 'required|email|max:255|unique:users,email',
                  'password' => 'required|min:6|max:18|confirmed',
              ];

              $messages = [
                  'name.required' => 'El campo es requerido',
                  'name.min' => 'El mínimo de caracteres permitidos son 3',
                  'name.max' => 'El máximo de caracteres permitidos son 16',
                  'name.regex' => 'Sólo se aceptan letras',
                  'email.required' => 'El campo es requerido',
                  'email.email' => 'El formato de email es incorrecto',
                  'email.max' => 'El máximo de caracteres permitidos son 255',
                  'email.unique' => 'El email ya existe',
                  'password.required' => 'El campo es requerido',
                  'password.min' => 'El mínimo de caracteres permitidos son 6',
                  'password.max' => 'El máximo de caracteres permitidos son 18',
                  'password.confirmed' => 'Los passwords no coinciden',
              ];

              $validator = Validator::make($request->all(), $rules, $messages);

              if ($validator->fails()) {
                  return redirect("auth/register")
                      ->withErrors($validator)
                      ->withInput();
              } else {
                  $user = new User;
                  $data['name'] = $user->name = $request->name;
                  $data['email'] = $user->email = $request->email;
                  $user->password = bcrypt($request->password);
                  $user->remember_token = str_random(100);
                  $data['confirm_token'] = $user->confirm_token = str_random(100);
                  $user->save();

                  Mail::send('emails.register', ['data' => $data], function ($mail) use ($data) {
                      $mail->subject('Confirma tu cuenta en somosAula');
                      $mail->sender('bj.devreugd@gmail.com');
                      $mail->to($data['email'], $data['name']);
                  });

                  return redirect("auth/register")
                      ->with("message", "Confirme su cuenta mediante el enlace enviado a su email");
              }


          }*/


}
