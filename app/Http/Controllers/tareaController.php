<?php

namespace somosAula\Http\Controllers;

use Illuminate\Http\Request;

use somosAula\asignaturas;
use somosAula\datosPersonales;
use somosAula\Http\Requests;
use somosAula\Http\Controllers\Controller;
use somosAula\tarea;
use Validator;
use somosAula\Colegio;
use somosAula\userRol;
use somosAula\user_tarea;
use DB;

class tareaController extends Controller
{

    public function postTarea(Request $request)
    {
        $rules = [

            'asignaturas' => 'required',
            'titulo' => 'required|min:3|max:250',
            'descripcion' => 'required|min:3|max:250',
            'fecha_ini' => 'required|date',
            'fecha_fin' => 'required|date',
        ];

        $messages = [
            'titulo.min' => 'El mínimo de caracteres permitidos son 3',
            'titulo.max' => 'El máximo de caracteres permitidos son 250',
            'titulo.regex' => 'Sólo se aceptan letras',
            'descripcion.min' => 'El mínimo de caracteres permitidos son 3',
            'descripcion.max' => 'El máximo de caracteres permitidos son 250',
            'fecha_fin.date' => 'El formato de date es incorrecto',
            'fecha_ini.date' => 'El formato de date es incorrecto',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("user")
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Error al agregar tarea");
        } else {
            $tarea = new tarea();
            $tarea->asignatura_id = $request->asignaturas;
            $tarea->titulo = $request->titulo;
            $tarea->descripcion = $request->descripcion;
            $tarea->fecha_inicio = $request->fecha_ini;
            $tarea->fecha_fin = $request->fecha_fin;
            $tarea->save();

            return redirect("user")
                ->with("success", "Tarea agregada");
        }
    }
    public function eliminarTarea(Request $request)
    {
        $rules = ['tarea_id' => 'integer'];
        $validator = Validator::make($request->only('tarea_id'), $rules);
        if ($validator->fails()) {
            return redirect('user')->with('error', 'Ha ocurrido un error');
        } else {
            if (user_tarea::where('tarea_id', '=', $request->tarea_id)->delete()
            ) {
                tarea::where('id', '=', $request->tarea_id)->delete();
                return redirect('user')->with('success', 'Tarea eliminada con exito');

            } else {
                return redirect('user')->with('error', 'Ha ocurrido un error');
            }
        }
    }

    public function asignTarea(Request $request)
    {
        $rules = [

            'alumno' => 'required',
            'tarea' => 'required',
        ];

        $messages = [
            'alumno.required' => 'Elija al menos a un alumno',
            'tarea.required' => 'Elija al menos una tarea',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("user")
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Error al asignar tarea");
        } else {
            $asigntarea = new user_tarea();
            $asigntarea->user_rol_id = $request->alumno;
            $asigntarea->tarea_id = $request->tarea;
            $asigntarea->save();

            return redirect("user")
                ->with("success", "Tarea asignada");
        }
    }
    
    public function editTarea(Request $request){

        $rules = [

            'asignaturas' => 'required',
            'titulo' => 'required|min:3|max:250',
            'descripcion' => 'required|min:3|max:250',
            'fecha_ini' => 'required|date',
            'fecha_fin' => 'required|date',
        ];

        $messages = [
            'asignaturas.required' => 'El campo es requerido',
            'titulo.required' => 'El campo es requerido',
            'titulo.min' => 'El mínimo de caracteres permitidos son 3',
            'titulo.max' => 'El máximo de caracteres permitidos son 250',
            'titulo.regex' => 'Sólo se aceptan letras',
            'descripcion.required' => 'El campo es requerido',
            'descripcion.min' => 'El mínimo de caracteres permitidos son 3',
            'descripcion.max' => 'El máximo de caracteres permitidos son 250',
            'fecha_fin.required' => 'El campo es requerido',
            'fecha_fin.date' => 'El formato de date es incorrecto',
            'fecha_ini.required' => 'El campo es requerido',
            'fecha_ini.date' => 'El formato de date es incorrecto',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("user")
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error al introducir los datos');
        } else {

            $tarea = new tarea;

            $tarea->where('id', '=', $request->tarea_id)
                ->update(['titulo' => $request->titulo,
                        'asignatura_id' => $request->asignaturas,
                        'descripcion' => $request->descripcion,
                        'fecha_inicio' => $request->fecha_ini,
                        'fecha_fin' => $request->fecha_fin]
                );


            return redirect("user")
                ->with("success", "edicion realizada con exito");
        }
        
    }
}
