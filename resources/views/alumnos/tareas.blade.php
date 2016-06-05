<?php

$the_user_rol_id = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();
$cod_aula_profe = somosAula\Colegio::select()
        ->join('user_rol', 'colegio.user_rol_id', '=', 'user_rol.id')
        ->where('colegio.user_rol_id', '=', $the_user_rol_id[0]['id'])->get();

$tareas = somosAula\user_tarea::select()
        ->join('user_rol', 'user_tarea.user_rol_id', '=', 'user_rol.id')
        ->join('datos_personales', 'user_rol.user_id', '=', 'datos_personales.user_id')
        ->join('tarea', 'user_tarea.tarea_id', '=', 'tarea.id')
        ->join('asignaturas', 'tarea.asignatura_id', '=', 'asignaturas.id')
        ->join('colegio', 'user_tarea.user_rol_id', '=', 'colegio.user_rol_id')
        ->where('colegio.cod_aula', '=', $cod_aula_profe[0]['cod_aula'])->get();

$asignartareas = somosAula\user_tarea::select()
        ->join('user_rol', 'user_tarea.user_rol_id', '=', 'user_rol.id')
        ->join('tarea', 'user_tarea.tarea_id', '=', 'tarea.id')
        ->join('asignaturas', 'tarea.asignatura_id', '=', 'asignaturas.id')
        ->join('datos_personales', 'user_rol.user_id', '=', 'datos_personales.user_id')
        ->join('colegio', 'user_tarea.user_rol_id', '=', 'colegio.user_rol_id')
        ->where('colegio.cod_aula', '=', $cod_aula_profe[0]['cod_aula'])
        ->where('colegio.user_rol_id', '<>', $the_user_rol_id[0]['id'])->get();


$alumnos = somosAula\datosPersonales::select()
        ->join('user_rol', 'user_rol.user_id', '=', 'datos_personales.user_id')
        ->join('colegio', 'user_rol.id', '=', 'colegio.user_rol_id')
        ->join('rol', 'user_rol.rol_id', '=', 'rol.id')
        ->where('colegio.cod_aula', '=', $cod_aula_profe[0]['cod_aula'])
        ->where('colegio.user_rol_id', '<>', $the_user_rol_id[0]['id'])->get();

$deberes = somosAula\tarea::select()->get();

$asignaturas = somosAula\asignaturas::all();

?>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss', autoclose: true});

</script>

@if($the_rol[0]['tipo'] == 'profesor')
    <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true"
           data-pagination="true">
        <thead>
        <tr>
            <th data-field="alumno" data-halign="center" data-align="center" data-sortable="true">Alumno</th>
            <th data-field="asignatura" data-halign="center" data-align="center" data-sortable="true">Asignatura</th>
            <th data-field="titulo" data-halign="center" data-align="center" data-sortable="true">
                Titulo
            </th>
            <th data-field="descripcion" data-halign="center" data-align="center" data-sortable="true">Descripción</th>
            <th data-field="fecha_inicio" data-halign="center" data-align="center" data-sortable="true">
                Fecha inicio
            </th>
            <th data-field="fecha_limite" data-halign="center" data-align="center" data-sortable="true">
                Fecha limite
            </th>
            @if($the_rol[0]['tipo'] == 'profesor')
                <th data-field="accion" data-halign="center" data-align="center" data-sortable="true">
                    acciones
                </th>
            @endif
        </tr>
        </thead>
        <tbody>

        @foreach($tareas as $tarea)
            <td>
                {{ $tarea->name }}
            </td>
            <td>
                {{ $tarea->nombre_asignatura }}
            </td>

            <td>
                {{ $tarea->titulo}}
            </td>
            <td>
                {{ $tarea->descripcion}}
            </td>
            <td>
                {{ $tarea->fecha_inicio}}
            </td>
            <td>
                {{ $tarea->fecha_fin}}
            </td>
            @if($the_rol[0]['tipo'] == 'profesor')
                <td>
                    <script type="text/javascript">
                        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss', autoclose: true});

                    </script>
                    <?php $optionASign = somosAula\user_tarea::select()
                            ->join('tarea', 'user_tarea.tarea_id', '=', 'tarea.id')
                            ->join('asignaturas', 'tarea.asignatura_id', '=', 'asignaturas.id')
                            ->where('asignaturas.nombre_asignatura', '=', $tarea->nombre_asignatura)->get();

                    ?>
                    <form method="post" action="{{url('alumnos/eliminartarea')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="tarea_id" value="{{$tarea->tarea_id}}"/>
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-trash-o"></i></button>
                        <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#{{$tarea->tarea_id}}"
                           href="#entra" role="button"><i class="fa fa-edit"></i></a>
                    </form>
                    <div class="modal fade" id="{{$tarea->tarea_id}}" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">×</span></button>
                                    <h2 class="modal-title" id="myModalLabel" aria-label="close">Asignar tarea a mis
                                        alumnos</h2>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" action="{{url('alumnos/editTarea')}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="tarea_id" value="{{$tarea->tarea_id}}"/>
                                        <br/>
                                        <div class="form-group">
                                            <label for="nombre_col">Asignatura</label>
                                            <div class="input-group">
                                                <select name="asignaturas" class="selectpicker">
                                                    <optgroup label="Actualmente seleccionado">
                                                        <option selected
                                                                value="{{$optionASign[0]['asignatura_id']}}">{{ $tarea->nombre_asignatura}}</option>
                                                    </optgroup>
                                                    <optgroup label="Asignaturas a seleccionar">
                                                        @foreach($asignaturas as $asignatura)
                                                            <option value="{{$asignatura->id}}">{{ $asignatura->nombre_asignatura}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="titulo">Titulo:</label>
                                            <input type="text" name="titulo" class="form-control"
                                                   value="{{$tarea->titulo}}"/>
                                            <div class="text-danger">{{$errors->first('titulo')}}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="descripcion">Descripcion:</label>
                                            <input type="textarea" name="descripcion" class="form-control"
                                                   value="{{$tarea->descripcion}}">
                                            <div class="text-danger">{{$errors->first('descripcion')}}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fechanacimiento">Fecha inicial:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="glyphicon glyphicon-calendar">
                                                    </i>
                                                </div>
                                                <input class="form-control form_datetime" id="date" name="fecha_ini"
                                                       type="text" value="{{$tarea->fecha_inicio}}"/>
                                                <div class="text-danger">{{$errors->first('fecha_ini')}}</div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label for="fechanacimiento">Fecha de entrega:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="glyphicon glyphicon-calendar">
                                                    </i>
                                                </div>
                                                <input class="form-control form_datetime" id="date" name="fecha_fin"
                                                       type="text" value="{{$tarea->fecha_fin}}"/>
                                                <div class="text-danger">{{$errors->first('fecha_fin')}}</div>
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary">Editar</button>
                                        </div>
                                    </form>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                @endif
                </tr>
                @endforeach
        </tbody>
    </table>

    <div class="pull-right">
        <a class="btn btn-primary btn-lg RegistPadreAlum" data-toggle="modal" data-target="#añadirTarea"
           href="#entra" role="button" id="login">Añadir tarea</a>
        <a class="btn btn-primary btn-lg RegistPadreAlum" data-toggle="modal" data-target="#asignarTarea"
           href="#entra" role="button" id="login">Asignar tarea</a>
    </div>
    <div class="modal fade" id="añadirTarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h2 class="modal-title" id="myModalLabel" aria-label="close">Añadir Tarea</h2>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{url('alumnos/tareas')}}">
                        {{csrf_field()}}

                        <br/>
                        <div class="form-group">
                            <label for="nombre_col">Asignatura</label>
                            <div class="input-group">
                                <select name="asignaturas" class="selectpicker">
                                    @foreach($asignaturas as $asignatura)
                                        <option value="{{$asignatura->id}}">{{$asignatura->nombre_asignatura}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="titulo">Titulo:</label>
                            <input type="text" name="titulo" class="form-control" value=""/>
                            <div class="text-danger">{{$errors->first('titulo')}}</div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion:</label>
                            <input type="textarea" name="descripcion" class="form-control">
                            <div class="text-danger">{{$errors->first('descripcion')}}</div>
                        </div>
                        <div class="form-group">
                            <label for="fechanacimiento">Fecha inicial:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar">
                                    </i>
                                </div>
                                <input class="form-control form_datetime" id="date" name="fecha_ini"
                                       type="text"/>
                                <div class="text-danger">{{$errors->first('fecha_ini')}}</div>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label for="fechanacimiento">Fecha de entrega:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar">
                                    </i>
                                </div>
                                <input class="form-control form_datetime" id="date" name="fecha_fin"
                                       type="text"/>
                                <div class="text-danger">{{$errors->first('fecha_fin')}}</div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Añadir</button>
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

    <div class="modal fade" id="asignarTarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h2 class="modal-title" id="myModalLabel" aria-label="close">Asignar tarea a mis alumnos</h2>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{url('alumnos/asigntareas')}}">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="nombre_col">Alumnos con el código{{ $cod_aula_profe[0]['cod_aula']}} </label><br/>
                            @foreach($alumnos as $alumno)
                                <input name="alumno" type="checkbox" id=""
                                       value="{{$alumno->user_rol_id}}"> <label
                                        for=""> {{$alumno->name}} </label>
                            @endforeach

                        </div>
                        <br/>

                        <div class="form-group">
                            <label for="nombre_col">Tareas para asignar</label><br/>
                            @foreach($deberes as $deber)
                                <input name="tarea" type="checkbox" id="{{$deber->id}}" value="{{$deber->id}}"> <label
                                        for="{{$deber->id}}"> {{$deber->titulo}} </label>
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
    $tareas = somosAula\user_tarea::select()
            ->join('user_rol', 'user_tarea.user_rol_id', '=', 'user_rol.id')
            ->join('datos_personales', 'user_rol.user_id', '=', 'datos_personales.user_id')
            ->join('tarea', 'user_tarea.tarea_id', '=', 'tarea.id')
            ->join('asignaturas', 'tarea.asignatura_id', '=', 'asignaturas.id')
            ->where('user_rol.id', '=', $the_user_rol_id[0]['id'])->get();

    ?>
    <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true"
           data-pagination="true">
        <thead>
        <tr>
            <th data-field="alumno" data-halign="center" data-align="center" data-sortable="true">Alumno</th>
            <th data-field="asignatura" data-halign="center" data-align="center" data-sortable="true">Asignatura</th>
            <th data-field="titulo" data-halign="center" data-align="center" data-sortable="true">
                Titulo
            </th>
            <th data-field="descripcion" data-halign="center" data-align="center" data-sortable="true">Descripción</th>
            <th data-field="fecha_inicio" data-halign="center" data-align="center" data-sortable="true">
                Fecha inicio
            </th>
            <th data-field="fecha_limite" data-halign="center" data-align="center" data-sortable="true">
                Fecha limite
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($tareas as $tarea)
            <td>
                {{ $tarea->name }}
            </td>
            <td>
                {{ $tarea->nombre_asignatura }}
            </td>

            <td>
                {{ $tarea->titulo}}
            </td>
            <td>
                {{ $tarea->descripcion}}
            </td>
            <td>
                {{ $tarea->fecha_inicio}}
            </td>
            <td>
                {{ $tarea->fecha_fin}}
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@elseif($the_rol[0]['tipo'] == 'tutor')
    <?php

    $the_user_rol_id = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();
    $tareas = somosAula\user_tarea::select()
            ->join('user_rol', 'user_tarea.user_rol_id', '=', 'user_rol.id')
            ->join('datos_personales', 'user_rol.user_id', '=', 'datos_personales.user_id')
            ->join('tarea', 'user_tarea.tarea_id', '=', 'tarea.id')
            ->join('asignaturas', 'tarea.asignatura_id', '=', 'asignaturas.id')
            ->join('tutorlegal_hijo', 'user_tarea.user_rol_id', '=', 'tutorlegal_hijo.hijo_id')
            ->where('tutorlegal_hijo.tutor_id', '=', $the_user_rol_id[0]['id'])->get();

    ?>
    <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true"
           data-pagination="true">
        <thead>
        <tr>
            <th data-field="alumno" data-halign="center" data-align="center" data-sortable="true">Alumno</th>
            <th data-field="asignatura" data-halign="center" data-align="center" data-sortable="true">Asignatura</th>
            <th data-field="titulo" data-halign="center" data-align="center" data-sortable="true">
                Titulo
            </th>
            <th data-field="descripcion" data-halign="center" data-align="center" data-sortable="true">Descripción</th>
            <th data-field="fecha_inicio" data-halign="center" data-align="center" data-sortable="true">
                Fecha inicio
            </th>
            <th data-field="fecha_limite" data-halign="center" data-align="center" data-sortable="true">
                Fecha limite
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($tareas as $tarea)
            <td>
                {{ $tarea->name }}
            </td>
            <td>
                {{ $tarea->nombre_asignatura }}
            </td>

            <td>
                {{ $tarea->titulo}}
            </td>
            <td>
                {{ $tarea->descripcion}}
            </td>
            <td>
                {{ $tarea->fecha_inicio}}
            </td>
            <td>
                {{ $tarea->fecha_fin}}
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif