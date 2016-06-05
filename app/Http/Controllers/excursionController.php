<?php

namespace somosAula\Http\Controllers;

use Illuminate\Http\Request;

use somosAula\excursion;
use somosAula\Http\Requests;
use somosAula\Http\Controllers\Controller;
use somosAula\user_excursion;
use Validator;
use somosAula\datosPersonales;
use somosAula\userRol;

class excursionController extends Controller
{
    public function postExcursion(Request $request)
    {

        $rules = [
            'titulo' => 'required|min:3|max:250',
            'descripcion' => 'required|min:3|max:250',
            'importe' => 'required|digits_between:0,2000',
            'fecha_exc' => 'required|date',
        ];

        $messages = [
            'titulo.required' => 'El campo es requerido',
            'titulo.min' => 'El mínimo de caracteres permitidos son 3',
            'titulo.max' => 'El máximo de caracteres permitidos son 16',
            'descripcion.required' => 'El campo es requerido',
            'descripcion.min' => 'El mínimo de caracteres permitidos son 3',
            'descripcion.max' => 'El máximo de caracteres permitidos son 16',
            'importe.required' => 'El campo es requerido',
            'importe.min' => 'El mínimo de caracteres permitidos son 0',
            'importe.max' => 'El máximo de caracteres permitidos son 2000',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("user")
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Error al agregar Excursion");;
        } else {

            $excursion = new excursion;
            $excursion->titulo = $request->titulo;
            $excursion->descripcion = $request->descripcion;
            $excursion->importe = $request->importe;
            $excursion->fecha_excursion = $request->fecha_exc;
            $excursion->save();

            return redirect("user")
                ->with("success", "Excursion agregada");
        }
    }
    public function eliminarExcursion(Request $request)
    {
        $rules = ['excursion_id' => 'integer'];
        $validator = Validator::make($request->only('excursion_id'), $rules);
        if ($validator->fails()) {
            return redirect('user')->with('error', 'Ha ocurrido un error');
        } else {
            if (user_excursion::where('excursion_id', '=', $request->excursion_id)->delete()
            ) {
                excursion::where('id', '=', $request->excursion_id)->delete();
                return redirect('user')->with('success', 'Excursion eliminada con exito');

            } else {
                return redirect('user')->with('error', 'Ha ocurrido un error');
            }
        }
    }

    public function asignExcursion(Request $request)
    {
        $rules = [
            'alumno' => 'required',
            'excursion' => 'required',
        ];

        $messages = [
            'alumno.required' => 'Seleccionar al menos un alumno es necesario',
            'excursion.required' => 'Seleccionar al menos una excursion es necesario',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("user")
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Error al asignar excursion");;
        } else {
            $asignexcur = new user_excursion;
            $asignexcur->user_rol_id = $request->alumno;
            $asignexcur->excursion_id = $request->excursion;
            $asignexcur->save();

            return redirect("user")
                ->with("success", "Excursion asignada");
        }
    }

    public function editExcursion(Request $request)
    {

        $rules = [
            'titulo' => 'required|min:3|max:250',
            'descripcion' => 'required|min:3|max:250',
            'importe' => 'required|numeric|between:0,2000.00',
            'fecha_exc' => 'required|date',
        ];

        $messages = [
            'titulo.required' => 'El campo es requerido',
            'titulo.min' => 'El mínimo de caracteres permitidos son 3',
            'titulo.max' => 'El máximo de caracteres permitidos son 250',
            'descripcion.required' => 'El campo es requerido',
            'descripcion.min' => 'El mínimo de caracteres permitidos son 3',
            'descripcion.max' => 'El máximo de caracteres permitidos son 250',
            'importe.required' => 'El campo es requerido',
            'importe.between' => 'fuera del rango permitido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("user")
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error al introducir los datos');
        } else {

            $excursion = new excursion;

            $excursion->where('id', '=', $request->excursion_id)
                ->update(['titulo' => $request->titulo,
                        'descripcion' => $request->descripcion,
                        'importe' => $request->importe,
                        'fecha_excursion' => $request->fecha_exc]
                );

            return redirect("user")
                ->with("success", "edicion realizada con exito");
        }

    }
}
