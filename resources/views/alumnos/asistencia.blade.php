<?php
$the_user_rol_id = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();

$cod_aula_profe = somosAula\Colegio::select()
        ->join('user_rol', 'colegio.user_rol_id', '=', 'user_rol.id')
        ->where('colegio.user_rol_id', '=', $the_user_rol_id[0]['id'])->get();

$asistencias = somosAula\user_asistencia::select()
        ->join('user_rol', 'user_asistencia.user_rol_id', '=', 'user_rol.id')
        ->join('rol', 'user_rol.rol_id', '=', 'rol.id')
        ->join('asistencia', 'user_asistencia.asistencia_id', '=', 'asistencia.id')
        ->join('asignaturas', 'asistencia.asignatura_id', '=', 'asignaturas.id')
        ->join('users', 'user_rol.user_id', '=', 'users.id')
        ->join('datos_personales', 'users.id', '=', 'datos_personales.user_id')
        ->join('colegio', 'user_asistencia.user_rol_id', '=', 'colegio.user_rol_id')
        ->where('colegio.cod_aula', '=', $cod_aula_profe[0]['cod_aula'])
        ->where('rol.tipo', '=', 'alumno')->get();

$asignaturas = somosAula\Asignaturas::all();
$usuarios = somosAula\datosPersonales::select()
        ->join('user_rol', 'datos_personales.user_id', '=', 'user_rol.user_id')
        ->join('rol', 'user_rol.rol_id', '=', 'rol.id')
        ->join('colegio', 'user_rol.id', '=', 'colegio.user_rol_id')
        ->where('colegio.cod_aula', '=', $cod_aula_profe[0]['cod_aula'])
        ->where('rol.tipo', '=', 'alumno')->get();

?>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss', autoclose: true});

</script>
@if($the_rol[0]['tipo'] == 'profesor')
    <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true"
           data-pagination="true">
        <thead>
        <tr>
            <th data-field="nombre" data-halign="center" data-align="center" data-sortable="true">Nombre</th>
            <th data-field="apellidos" data-halign="center" data-align="center" data-sortable="true">
                Apellidos
            </th>
            <th data-field="asignatura" data-halign="center" data-align="center" data-sortable="true">Asignatura</th>
            <th data-field="fecha_clase" data-halign="center" data-align="center" data-sortable="true">
                Fecha clase
            </th>
            <th data-field="asistencia" data-halign="center" data-align="center" data-sortable="true">
                asistencia
            </th>
            @if($the_rol[0]['tipo'] == 'profesor')
                <th data-field="accion" data-halign="center" data-align="center" data-sortable="true">
                    Acciones
                </th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($asistencias as $asistencia)
            <td>
                {{ $asistencia->name }}
            </td>

            <td>
                {{ $asistencia->secondname}}
                {{ $asistencia->secondname2}}
            </td>
            <td>
                {{ $asistencia->nombre_asignatura}}
            </td>
            <td>
                {{ $asistencia->fecha_clase}}
            </td>
            <td>
                @if($asistencia->asiste == 0)
                    <span style="color: red;">No presentado</span>
                @else
                    <span>Presentado</span>

                @endif
            </td>
            @if($the_rol[0]['tipo'] == 'profesor')
                <td>
                    <script type="text/javascript">
                        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss', autoclose: true});

                    </script>
                    <form method="post" action="{{url('alumnos/eliminarasistencia')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="asistencia_id" value="{{$asistencia->asistencia_id}}"/>
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-trash-o"></i></button>

                        <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#{{$asistencia->id}}"
                           href="#entra" role="button"><i class="fa fa-edit"></i></a>
                    </form>

                    <div class="modal fade" id="{{$asistencia->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">×</span></button>
                                    <h2 class="modal-title" id="myModalLabel" aria-label="close">Editar asistencia</h2>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" action="{{url('alumnos/editAsistencia')}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="asistencia_id"
                                               value="{{$asistencia->asistencia_id}}"/>
                                        <br/>

                                        <div class="form-group">
                                            <label for="nombre_col">Nombre del alumno:</label>
                                            <div class="input-group">
                                                <select name="nombre" class="selectpicker">
                                                    <optgroup label="Actualmente seleccionado">
                                                        <option selected
                                                                value="{{$asistencia->name}}">{{ $asistencia->name}}</option>
                                                    </optgroup>
                                                    <optgroup label="Nombres a seleccionar">
                                                        @foreach($usuarios as $usuario)
                                                            <option value="{{$usuario->name}}">{{$usuario->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="titulo">Apellido del alumno:</label>
                                            <div class="input-group">
                                                <select name="apellido" class="selectpicker">
                                                    <optgroup label="Actualmente seleccionado">
                                                        <option selected
                                                                value="{{$asistencia->secondname}}">{{ $asistencia->secondname}}</option>
                                                    </optgroup>
                                                    <optgroup label="Primer apellido a seleccionar">
                                                        @foreach($usuarios as $usuario)
                                                            <option value="{{$usuario->secondname}}">{{$usuario->secondname}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <?php
                                        $optionASign = somosAula\user_asistencia::select()
                                                ->join('asistencia', 'user_asistencia.asistencia_id', '=', 'asistencia.id')
                                                ->join('asignaturas', 'asistencia.asignatura_id', '=', 'asignaturas.id')
                                                ->where('asignaturas.nombre_asignatura', '=', $asistencia->nombre_asignatura)->get();
                                        ?>
                                        <div class="form-group">
                                            <label for="nombre_col">Asignatura</label>
                                            <div class="input-group">
                                                <select name="asignaturas" class="selectpicker">
                                                    <optgroup label="Actualmente seleccionado">
                                                        <option selected
                                                                value="{{$optionASign[0]['asignatura_id']}}">{{ $asistencia->nombre_asignatura}}</option>
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
                                            <label for="fecha">Fecha clase:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="glyphicon glyphicon-calendar">
                                                    </i>
                                                </div>
                                                <input class="form-control form_datetime" id="date" name="fecha"
                                                       type="text" value="{{$asistencia->fecha_clase}}"/>
                                                <div class="text-danger">{{$errors->first('fecha')}}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="nombre_col">Asistencia</label>
                                            <div class="input-group">
                                                <select name="asistencia" class="selectpicker">
                                                    <option value="0">No presente</option>
                                                    <option value="1">Presente</option>
                                                </select>
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
            <a class="btn btn-primary btn-lg RegistPadreAlum" data-toggle="modal" data-target="#añadirAsist"
               href="#entra" role="button" id="login">Asistencia alumno</a>
        </div>
        <div class="modal fade" id="añadirAsist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h2 class="modal-title" id="myModalLabel" aria-label="close">Pasar falta</h2>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="{{url('alumnos/asistencia')}}">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="nombre_col">Nombre del alumno:</label>
                                <div class="input-group">
                                    <select name="nombre" class="selectpicker">
                                        @foreach($usuarios as $usuario)
                                            <option value="{{$usuario->name}}">{{$usuario->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="titulo">Apellido del alumno:</label>
                                <div class="input-group">
                                    <select name="apellido" class="selectpicker">
                                        @foreach($usuarios as $usuario)
                                            <option value="{{$usuario->secondname}}">{{$usuario->secondname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

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
                                <label for="fecha">Fecha clase:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar">
                                        </i>
                                    </div>
                                    <input class="form-control form_datetime" id="date" name="fecha"
                                           type="text"/>
                                    <div class="text-danger">{{$errors->first('fecha')}}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nombre_col">Asistencia</label>
                                <div class="input-group">
                                    <select name="asistencia" class="selectpicker">
                                        <option value="0">No presente</option>
                                        <option selected value="1">Presente</option>
                                    </select>
                                </div>
                            </div>

                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">Enviar</button>
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
        $asistencias = somosAula\user_asistencia::select()
                ->join('user_rol', 'user_asistencia.user_rol_id', '=', 'user_rol.id')
                ->join('rol', 'user_rol.rol_id', '=', 'rol.id')
                ->join('asistencia', 'user_asistencia.asistencia_id', '=', 'asistencia.id')
                ->join('asignaturas', 'asistencia.asignatura_id', '=', 'asignaturas.id')
                ->join('users', 'user_rol.user_id', '=', 'users.id')
                ->join('datos_personales', 'users.id', '=', 'datos_personales.user_id')
                ->where('user_rol.id', '=', $the_user_rol_id[0]['id'])->get();

        ?>
        <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true"
               data-pagination="true">
            <thead>
            <tr>
                <th data-field="nombre" data-halign="center" data-align="center" data-sortable="true">Nombre</th>
                <th data-field="apellidos" data-halign="center" data-align="center" data-sortable="true">
                    Apellidos
                </th>
                <th data-field="asignatura" data-halign="center" data-align="center" data-sortable="true">Asignatura
                </th>
                <th data-field="fecha_clase" data-halign="center" data-align="center" data-sortable="true">
                    Fecha clase
                </th>
                <th data-field="asistencia" data-halign="center" data-align="center" data-sortable="true">
                    asistencia
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($asistencias as $asistencia)
                <td>
                    {{ $asistencia->name }}
                </td>

                <td>
                    {{ $asistencia->secondname}}
                    {{ $asistencia->secondname2}}
                </td>
                <td>
                    {{ $asistencia->nombre_asignatura}}
                </td>
                <td>
                    {{ $asistencia->fecha_clase}}
                </td>
                <td>
                    @if($asistencia->asiste == 0)
                        <span style="color: red;">No presentado</span>
                    @else
                        <span>Presentado</span>

                    @endif
                </td>
                </tr>
            @endforeach

            </tbody>
        </table>

@elseif($the_rol[0]['tipo'] == 'tutor')
    <?php
    $the_user_rol_id = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();
    $asistencias = somosAula\user_asistencia::select()
            ->join('user_rol', 'user_asistencia.user_rol_id', '=', 'user_rol.id')
            ->join('rol', 'user_rol.rol_id', '=', 'rol.id')
            ->join('asistencia', 'user_asistencia.asistencia_id', '=', 'asistencia.id')
            ->join('asignaturas', 'asistencia.asignatura_id', '=', 'asignaturas.id')
            ->join('users', 'user_rol.user_id', '=', 'users.id')
            ->join('datos_personales', 'users.id', '=', 'datos_personales.user_id')
            ->join('tutorlegal_hijo', 'user_asistencia.user_rol_id', '=', 'tutorlegal_hijo.hijo_id')
            ->where('tutorlegal_hijo.tutor_id', '=', $the_user_rol_id[0]['id'])->get();

    ?>
    <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true"
           data-pagination="true">
        <thead>
        <tr>
            <th data-field="nombre" data-halign="center" data-align="center" data-sortable="true">Nombre</th>
            <th data-field="apellidos" data-halign="center" data-align="center" data-sortable="true">
                Apellidos
            </th>
            <th data-field="asignatura" data-halign="center" data-align="center" data-sortable="true">Asignatura
            </th>
            <th data-field="fecha_clase" data-halign="center" data-align="center" data-sortable="true">
                Fecha clase
            </th>
            <th data-field="asistencia" data-halign="center" data-align="center" data-sortable="true">
                asistencia
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($asistencias as $asistencia)
            <td>
                {{ $asistencia->name }}
            </td>

            <td>
                {{ $asistencia->secondname}}
                {{ $asistencia->secondname2}}
            </td>
            <td>
                {{ $asistencia->nombre_asignatura}}
            </td>
            <td>
                {{ $asistencia->fecha_clase}}
            </td>
            <td>
                @if($asistencia->asiste == 0)
                    <span style="color: red;">No presentado</span>
                @else
                    <span>Presentado</span>

                @endif
            </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endif