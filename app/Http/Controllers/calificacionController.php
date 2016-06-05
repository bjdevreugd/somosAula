<?php

namespace somosAula\Http\Controllers;

use Illuminate\Http\Request;

use somosAula\alum_asig_curs_grad;
use somosAula\asig_curs_grad;
use somosAula\asignaturas;
use somosAula\curso;
use somosAula\curso_educativo;
use somosAula\datosPersonales;
use somosAula\grado_educativo;
use somosAula\Http\Requests;
use somosAula\Http\Controllers\Controller;
use somosAula\userRol;
use Validator;

class calificacionController extends Controller
{
    public function postCalificacion(Request $request)
    {

        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'asignaturas' => 'required',
            'curso' => 'required',
            'grado' => 'required',
            'nota' => 'required|numeric|between:0,10.00',
            'descripcion' => 'required|min:3|max:250',
        ];

        $messages = [
            'nombre.required' => 'El campo es requerido',
            'apellido.required' => 'El campo es requerido',
            'asignaturas.required' => 'El campo es requerido',
            'curso.required' => 'El campo es requerido',
            'grado.required' => 'El campo es requerido',
            'descripcion.required' => 'El campo es requerido',
            'descripcion.min' => 'El mínimo de caracteres permitidos son 3',
            'descripcion.max' => 'El máximo de caracteres permitidos son 250',
            'nota.required' => 'El campo es requerido',
            'nota.between' => 'fuera del rango permitido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("user")
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Error al agregar la califiacion");
        } else {

            $curso_educativo = curso_educativo::select()
                ->where('curso_id', '=', $request->curso)
                ->where('grado_id', '=', $request->grado)->get();

            $asig_curso_grado = asig_curs_grad::select()
                ->where('asignatura_id', '=', $request->asignaturas)
                ->where('curso_grado_id', '=', $curso_educativo[0]['id'])->get();


            $usuario_rol = datosPersonales::select()
                ->where('datos_personales.name', '=', $request->nombre)
                ->where('datos_personales.secondname', '=', $request->apellido)->get();

            $usrrol = userRol::select()
                ->where('user_id', '=', $usuario_rol[0]['user_id'])->get();

            $alum_asig_curso_grado = new alum_asig_curs_grad;
            $alum_asig_curso_grado->user_rol_id = $usrrol[0]['id'];
            $alum_asig_curso_grado->asig_curs_grad_id = $asig_curso_grado[0]['id'];
            $alum_asig_curso_grado->nota = $request->nota;
            $alum_asig_curso_grado->descripcion = $request->descripcion;
            $alum_asig_curso_grado->save();
            return redirect("user")
                ->with("success", "Calificacion agregada");
        }
    }

    public function eliminarCalificacion(Request $request)
    {
        $rules = ['asig_curs_grad_id' => 'integer'];
        $validator = Validator::make($request->only('asig_curs_grad_id'), $rules);
        if ($validator->fails()) {
            return redirect('user')->with('error', 'Ha ocurrido un error');
        } else {
            if (alum_asig_curs_grad::where('asig_curs_grad_id', '=', $request->asig_curs_grad_id)->delete()
            ) {
                asig_curs_grad::where('id', '=', $request->asig_curs_grad_id)->delete();
                return redirect('user')->with('success', 'Calificacion eliminada con éxito');

            } else {
                return redirect('user')->with('error', 'Ha ocurrido un error');
            }
        }
    }

    public function editCalificacion(Request $request)
    {

        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'asignaturas' => 'required',
            'curso' => 'required',
            'grado' => 'required',
            'nota' => 'required|numeric|between:0,10.00',
            'descripcion' => 'required|min:3|max:250',
        ];

        $messages = [
            'nombre.required' => 'El campo es requerido',
            'apellido.required' => 'El campo es requerido',
            'asignaturas.required' => 'El campo es requerido',
            'curso.required' => 'El campo es requerido',
            'grado.required' => 'El campo es requerido',
            'descripcion.required' => 'El campo es requerido',
            'descripcion.min' => 'El mínimo de caracteres permitidos son 3',
            'descripcion.max' => 'El máximo de caracteres permitidos son 250',
            'nota.required' => 'El campo es requerido',
            'nota.between' => 'fuera del rango permitido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("user")
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error al introducir los datos');
        } else {


            $curso_grado = curso_educativo::select()
                ->where('curso_id', '=', $request->curso)
                ->where('grado_id', '=', $request->grado)->get();

            $alumgrad = new asig_curs_grad;

            $alumgrad->where('id', '=', $request->asig_curs_grad_id)
                ->update(['asignatura_id' => $request->asignaturas,
                        'curso_grado_id' => $curso_grado[0]['id']]
                );

            $usuario_rol = datosPersonales::select()
                ->where('datos_personales.name', '=', $request->nombre)
                ->where('datos_personales.secondname', '=', $request->apellido)->get();

            $usrrol = userRol::select()
                ->where('user_id', '=', $usuario_rol[0]['user_id'])->get();

            $alumgrad = new alum_asig_curs_grad;

            $alumgrad->where('asig_curs_grad_id', '=', $request->asig_curs_grad_id)
                ->update(['user_rol_id' => $usrrol[0]['id'],
                        'nota' => $request->nota,
                        'descripcion' => $request->descripcion]
                );

            return redirect("user")
                ->with("success", "edicion realizada con exito");
        }

    }
}
