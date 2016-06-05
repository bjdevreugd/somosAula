<?php

namespace somosAula\Http\Controllers;

use Illuminate\Http\Request;

use somosAula\asistencia;
use somosAula\Http\Requests;
use somosAula\Http\Controllers\Controller;
use somosAula\user_asistencia;
use somosAula\datosPersonales;
use somosAula\userRol;
use Validator;

class asistenciaController extends Controller
{
    public function postAsistencia(Request $request)
    {

        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'asignaturas' => 'required',
            'fecha' => 'required|date',
            'asistencia' => 'required',
        ];

        $messages = [
            'nombre.required' => 'El campo es requerido',
            'apellido.required' => 'El campo es requerido',
            'asignaturas.required' => 'El campo es requerido',
            'fecha.required' => 'El campo es requerido',
            'asistencia.required' => 'El campo es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("user")
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Error al agregar asistencia");;
        } else {


            $usuario_rol = datosPersonales::select()
                ->where('datos_personales.name', '=', $request->nombre)
                ->where('datos_personales.secondname', '=', $request->apellido)->get();

            $usrrol = userRol::select()
                ->where('user_id', '=', $usuario_rol[0]['user_id'])->get();

            $asistencia = new asistencia();
            $asistencia->asignatura_id = $request->asignaturas;
            $asistencia->fecha_clase = $request->fecha;
            $asistencia->save();
            $insertedId = $asistencia->id;
            $usuario_asistencia = new user_asistencia();
            $usuario_asistencia->asiste = $request->asistencia;
            $usuario_asistencia->user_rol_id = $usrrol[0]['id'];
            $usuario_asistencia->asistencia_id = $insertedId;
            $usuario_asistencia->save();

            return redirect("user")
                ->with("success", "Asistencia agregada");
        }
    }

    public function eliminarAsistencia(Request $request)
    {
        $rules = ['asistencia_id' => 'integer'];
        $validator = Validator::make($request->only('asistencia_id'), $rules);
        if ($validator->fails()) {
            return redirect('user')->with('error', 'Ha ocurrido un error');
        } else {
            if (user_asistencia::where('asistencia_id', '=', $request->asistencia_id)->delete()
            ) {
                asistencia::where('id', '=', $request->asistencia_id)->delete();
                return redirect('user')->with('success', 'Asistencia eliminada con exito');

            } else {
                return redirect('user')->with('error', 'Ha ocurrido un error');
            }
        }
    }

    public function editAsistencia(Request $request)
    {

        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'asignaturas' => 'required',
            'fecha' => 'required|date',
            'asistencia' => 'required',
        ];

        $messages = [
            'nombre.required' => 'El campo es requerido',
            'apellido.required' => 'El campo es requerido',
            'asignaturas.required' => 'El campo es requerido',
            'fecha.required' => 'El campo es requerido',
            'asistencia.required' => 'El campo es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("user")
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error al introducir los datos');
        } else {

            $asistencia = new asistencia;

            $asistencia->where('id', '=', $request->asistencia_id)
                ->update(['asignatura_id' => $request->asignaturas,
                        'fecha_clase' => $request->fecha]
                );

            $usuario_asistencia = new user_asistencia;

            $usuario_rol = datosPersonales::select()
                ->where('datos_personales.name', '=', $request->nombre)
                ->where('datos_personales.secondname', '=', $request->apellido)->get();

            $usrrol = userRol::select()
                ->where('user_id', '=', $usuario_rol[0]['user_id'])->get();

            $usuario_asistencia->where('asistencia_id', '=', $request->asistencia_id)
                ->update(['asiste' => $request->asistencia,
                        'user_rol_id' => $usrrol[0]['id']]
                );

            return redirect("user")
                ->with("success", "edicion realizada con exito");
        }

    }
}
