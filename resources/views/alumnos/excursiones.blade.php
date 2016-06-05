<?php
$the_user_rol_id = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();

$cod_aula_profe = somosAula\Colegio::select()
        ->join('user_rol', 'colegio.user_rol_id', '=', 'user_rol.id')
        ->where('colegio.user_rol_id', '=', $the_user_rol_id[0]['id'])->get();

$excursiones = somosAula\user_excursion::select()
        ->join('user_rol', 'user_excursion.user_rol_id', '=', 'user_rol.id')
        ->join('excursion', 'user_excursion.excursion_id', '=', 'excursion.id')
        ->join('colegio', 'user_excursion.user_rol_id', '=', 'colegio.user_rol_id')
        ->where('colegio.cod_aula', '=', $cod_aula_profe[0]['cod_aula'])->get();

?>
@if($the_rol[0]['tipo'] == 'profesor')
<table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true" data-pagination="true">
    <thead>
    <tr>
        <th data-field="titulo" data-halign="center" data-align="center" data-sortable="true">
            Titulo
        </th>
        <th data-field="descripcion" data-halign="center" data-align="center" data-sortable="true">Descripción</th>
        <th data-field="importe" data-halign="center" data-align="center" data-sortable="true">
            importe a pagar (<i class="fa fa-euro"></i>)
        </th>
        <th data-field="fecha_excursion" data-halign="center" data-align="center" data-sortable="true">
            Fecha de la excursion
        </th>

        <th data-field="acciones" data-halign="center" data-align="center" data-sortable="true">
            acciones
        </th>
    </tr>
    </thead>
    <tbody>

    @foreach($excursiones as $excursion)
        <td>
            {{ $excursion->titulo}}
        </td>
        <td>
            {{ $excursion->descripcion}}
        </td>
        <td>
            {{ $excursion->importe}}
        </td>
        <td>
            {{ $excursion->fecha_excursion}}
        </td>
        <td>
            <form method="post" action="{{url('alumnos/eliminarexcursion')}}">
                {{csrf_field()}}
                <input type="hidden" name="excursion_id" value="{{$excursion->excursion_id}}"/>
                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-trash-o"></i></button>
                <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#{{$excursion->excursion_id}}"
                   href="#entra" role="button"><i class="fa fa-edit"></i></a>
            </form>
            <div class="modal fade" id="{{$excursion->excursion_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                            <h2 class="modal-title" id="myModalLabel" aria-label="close">Editar excursión</h2>
                        </div>
                        <div class="modal-body">

                            <form method="POST" action="{{url('alumnos/editexcursion')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="excursion_id" value="{{$excursion->excursion_id}}"/>
                                <br/>

                                <div class="form-group">
                                    <label for="titulo">Titulo:</label>
                                    <input type="text" name="titulo" class="form-control" value="{{ $excursion->titulo}}"/>
                                    <div class="text-danger">{{$errors->first('titulo')}}</div>
                                </div>

                                <div class="form-group">
                                    <label for="descripcion">Descripcion:</label>
                                    <input type="text" name="descripcion" class="form-control" value="{{ $excursion->descripcion}}"/>
                                    <div class="text-danger">{{$errors->first('descripcion')}}</div>
                                </div>

                                <div class="form-group">
                                    <label for="importe">Importe a pagar:</label>
                                    <input type="text" name="importe" class="form-control" value="{{ $excursion->importe}}"/>
                                    <div class="text-danger">{{$errors->first('importe')}}</div>
                                </div>

                                <div class="form-group">
                                    <label for="fecha_exc">Fecha de la excursion:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-calendar">
                                            </i>
                                        </div>
                                        <input class="form-control form_datetime" id="date" name="fecha_exc"
                                               type="text" value="{{ $excursion->fecha_excursion}}"/>
                                        <div class="text-danger">{{$errors->first('fecha_exc')}}</div>
                                    </div>
                                </div>


                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Editar excursion</button>
                                </div>
                            </form>
                            <br/>
                            <br/>
                            <br/>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        </tr>
    @endforeach

    </tbody>
</table>

    <div class="pull-right">
        <a class="btn btn-primary btn-lg RegistPadreAlum" data-toggle="modal" data-target="#añadirExcur"
           href="#entra" role="button" id="login">Añadir excursion</a>
        <a class="btn btn-primary btn-lg RegistPadreAlum" data-toggle="modal" data-target="#asignarExcursion"
           href="#entra" role="button" id="login">Asignar excursion</a>
    </div>
    <div class="modal fade" id="añadirExcur" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h2 class="modal-title" id="myModalLabel" aria-label="close">Añadir excursion</h2>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{url('alumnos/excursion')}}">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="titulo">Titulo:</label>
                            <input type="text" name="titulo" class="form-control"/>
                            <div class="text-danger">{{$errors->first('titulo')}}</div>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" name="descripcion" class="form-control"/>
                            <div class="text-danger">{{$errors->first('descripcion')}}</div>
                        </div>

                        <div class="form-group">
                            <label for="importe">Importe a pagar:</label>
                            <input type="text" name="importe" class="form-control" value=""/>
                            <div class="text-danger">{{$errors->first('importe')}}</div>
                        </div>

                        <div class="form-group">
                            <label for="fecha_exc">Fecha de la excursion:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar">
                                    </i>
                                </div>
                                <input class="form-control form_datetime" id="date" name="fecha_exc"
                                       type="text"/>
                                <div class="text-danger">{{$errors->first('fecha_exc')}}</div>
                            </div>
                        </div>


                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Enviar excursion</button>
                        </div>
                    </form>
                    <br/>
                    <br/>
                    <br/>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="asignarExcursion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h2 class="modal-title" id="myModalLabel" aria-label="close">Asignar tarea a mis alumnos</h2>
                </div>
                <div class="modal-body">

                    <?php

                    $alumnos = somosAula\datosPersonales::select()
                            ->join('user_rol', 'user_rol.user_id', '=', 'datos_personales.user_id')
                            ->join('colegio', 'user_rol.id', '=', 'colegio.user_rol_id')
                            ->join('rol', 'user_rol.rol_id', '=', 'rol.id')
                            ->where('rol.tipo', '=', 'alumno')
                            ->where('colegio.cod_aula', '=', $cod_aula_profe[0]['cod_aula'])
                            ->where('colegio.user_rol_id', '<>', $the_user_rol_id[0]['id'])->get();

                    $excursiones = somosAula\excursion::select()->get();
                    ?>

                    <form method="POST" action="{{url('alumnos/asignexcur')}}">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="nombre_col">Alumnos con el código {{$cod_aula_profe[0]['cod_aula']}}</label><br/>
                            @foreach($alumnos as $alumno)
                                <input name="alumno" type="checkbox" id=""
                                       value="{{$alumno->user_rol_id}}"> <label
                                        for=""> {{$alumno->name}} </label>
                            @endforeach

                        </div>
                        <br/>

                        <div class="form-group">
                            <label for="nombre_col">Tareas para asignar</label><br/>
                            @foreach($excursiones as $excursion)
                                <input name="excursion" type="checkbox" id="{{$excursion->id}}"
                                       value="{{$excursion->id}}"> <label
                                        for="{{$excursion->id}}"> {{$excursion->titulo}} </label>
                            @endforeach
                        </div>

                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Asignar</button>
                        </div>
                    </form>
                    <br/>
                    <br/>
                    <br/>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@elseif($the_rol[0]['tipo'] == 'alumno')
    <?php
    $the_user_rol_id = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();
    $excursiones = somosAula\user_excursion::select()
            ->join('user_rol', 'user_excursion.user_rol_id', '=', 'user_rol.id')
            ->join('excursion', 'user_excursion.excursion_id', '=', 'excursion.id')
            ->where('user_rol.id', '=',$the_user_rol_id[0]['id'])->get();

    ?>
    <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true" data-pagination="true">
        <thead>
        <tr>
            <th data-field="titulo" data-halign="center" data-align="center" data-sortable="true">
                Titulo
            </th>
            <th data-field="descripcion" data-halign="center" data-align="center" data-sortable="true">Descripción</th>
            <th data-field="importe" data-halign="center" data-align="center" data-sortable="true">
                importe a pagar (<i class="fa fa-euro"></i>)
            </th>
            <th data-field="fecha_excursion" data-halign="center" data-align="center" data-sortable="true">
                Fecha de la excursion
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($excursiones as $excursion)
            <tr>
            <td>
                {{ $excursion->titulo}}
            </td>
            <td>
                {{ $excursion->descripcion}}
            </td>
            <td>
                {{ $excursion->importe}}
            </td>
            <td>
                {{ $excursion->fecha_excursion}}
            </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@elseif($the_rol[0]['tipo'] == 'tutor')
    <?php
    $the_user_rol_id = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();
    $excursiones = somosAula\user_excursion::select()
            ->join('user_rol', 'user_excursion.user_rol_id', '=', 'user_rol.id')
            ->join('excursion', 'user_excursion.excursion_id', '=', 'excursion.id')
            ->join('tutorlegal_hijo', 'user_excursion.user_rol_id', '=', 'tutorlegal_hijo.hijo_id')
            ->where('tutorlegal_hijo.tutor_id', '=', $the_user_rol_id[0]['id'])->get()

    ?>
    <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true" data-pagination="true">
        <thead>
        <tr>
            <th data-field="titulo" data-halign="center" data-align="center" data-sortable="true">
                Titulo
            </th>
            <th data-field="descripcion" data-halign="center" data-align="center" data-sortable="true">Descripción</th>
            <th data-field="importe" data-halign="center" data-align="center" data-sortable="true">
                importe a pagar (<i class="fa fa-euro"></i>)
            </th>
            <th data-field="fecha_excursion" data-halign="center" data-align="center" data-sortable="true">
                Fecha de la excursion
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($excursiones as $excursion)
            <tr>
                <td>
                    {{ $excursion->titulo}}
                </td>
                <td>
                    {{ $excursion->descripcion}}
                </td>
                <td>
                    {{ $excursion->importe}}
                </td>
                <td>
                    {{ $excursion->fecha_excursion}}
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endif

