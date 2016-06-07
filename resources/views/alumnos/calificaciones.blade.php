<?php
$the_user_rol_id = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();

$cod_aula_profe = somosAula\Colegio::select()
        ->join('user_rol', 'colegio.user_rol_id', '=', 'user_rol.id')
        ->where('colegio.user_rol_id', '=', $the_user_rol_id[0]['id'])->get();

$calificaciones = somosAula\alum_asig_curs_grad::select()
        ->join('user_rol', 'alum_asig_curs_grad.user_rol_id', '=', 'user_rol.id')
        ->join('users', 'user_rol.user_id', '=', 'users.id')
        ->join('datos_personales', 'users.id', '=', 'datos_personales.user_id')
        ->join('asig_curs_grad', 'alum_asig_curs_grad.asig_curs_grad_id', '=', 'asig_curs_grad.id')
        ->join('asignaturas', 'asig_curs_grad.asignatura_id', '=', 'asignaturas.id')
        ->join('curso_educativo', 'asig_curs_grad.curso_grado_id', '=', 'curso_educativo.id')
        ->join('curso', 'curso_educativo.curso_id', '=', 'curso.id')
        ->join('grado_educativo', 'curso_educativo.grado_id', '=', 'grado_educativo.id')
        ->join('colegio', 'alum_asig_curs_grad.user_rol_id', '=', 'colegio.user_rol_id')
        ->where('colegio.cod_aula', '=', $cod_aula_profe[0]['cod_aula'])->get();

$asignaturas = somosAula\Asignaturas::all();
$usuarios = somosAula\datosPersonales::select()
        ->join('user_rol', 'datos_personales.user_id', '=', 'user_rol.user_id')
        ->join('rol', 'user_rol.rol_id', '=', 'rol.id')
        ->join('colegio', 'user_rol.id', '=', 'colegio.user_rol_id')
        ->where('colegio.cod_aula', '=', $cod_aula_profe[0]['cod_aula'])
        ->where('rol.tipo', '=', 'alumno')->get();

$cursos = somosAula\curso::all();
$grados_educativos = somosAula\grado_educativo::all();

?>
<h1 class="col-lg-offset-5">Calificaciones</h1>

@if($the_rol[0]['tipo'] == 'profesor')
    <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true"
           data-pagination="true" id="table">
        <thead>
        <tr>
            <th data-field="name" data-halign="center" data-align="center" data-sortable="true">Nombre</th>
            <th data-field="secondname" data-halign="center" data-align="center" data-sortable="true">
                Apellidos
            </th>
            <th data-field="asignatura" data-halign="center" data-align="center" data-sortable="true">Asignatura</th>
            <th data-field="curso" data-halign="center" data-align="center" data-sortable="true">
                Curso
            </th>
            <th data-field="grado" data-halign="center" data-align="center" data-sortable="true">
                Grado
            </th>
            <th data-field="nota" data-halign="center" data-align="center" data-sortable="true">Nota
            </th>
            <th data-field="descripcion" data-halign="center" data-align="center" data-sortable="true">Descripción
            </th>
            @if($the_rol[0]['tipo'] == 'profesor')
                <th data-field="accion" data-halign="center" data-align="center" data-sortable="true">
                    Acciones
                </th>
            @endif
        </tr>
        </thead>
        <tbody>

        @foreach($calificaciones as $calificacion)
            <td>
                {{ $calificacion->name }}
            </td>

            <td>
                {{ $calificacion->secondname}}
                {{ $calificacion->secondname2}}
            </td>
            <td>
                {{ $calificacion->nombre_asignatura}}
            </td>
            <td>
                {{ $calificacion->nombre_curso}}
            </td>
            <td>
                {{ $calificacion->grado}}
            </td>
            @if($calificacion->nota<5)
                <td>
                    <span style="color: red">{{ $calificacion->nota}}</span>
                </td>
            @else
                <td>
                    <span style="color: green"> {{ $calificacion->nota}}</span>
                </td>
            @endif
            <td>{{$calificacion->descripcion}}</td>
            @if($the_rol[0]['tipo'] == 'profesor')
                <td>
                    <form method="post" action="{{url('alumnos/eliminarcalificacion')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="asig_curs_grad_id" value="{{$calificacion->asig_curs_grad_id}}"/>
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-trash-o"></i></button>
                        <a class="btn btn-primary btn-lg" data-toggle="modal"
                           data-target="#{{$calificacion->asig_curs_grad_id}}"
                           href="#entra" role="button"><i class="fa fa-edit"></i></a>
                    </form>
                    <div class="modal fade" id="{{$calificacion->asig_curs_grad_id}}" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">×</span></button>
                                    <h2 class="modal-title" id="myModalLabel" aria-label="close">Editar
                                        calificación</h2>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" action="{{url('alumnos/editCalificacion')}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="asig_curs_grad_id"
                                               value="{{$calificacion->asig_curs_grad_id}}"/>
                                        <br/>

                                        <div class="form-group">
                                            <label for="nombre_col">Nombre del alumno:</label>
                                            <div class="input-group">
                                                <select name="nombre" class="selectpicker">
                                                    <optgroup label="Actualmente seleccionado">
                                                        <option selected
                                                                value="{{$calificacion->name}}">{{ $calificacion->name}}</option>
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
                                                                value="{{$calificacion->secondname}}">{{ $calificacion->secondname}}</option>
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
                                        $optionASign = somosAula\alum_asig_curs_grad::select()
                                                ->join('asig_curs_grad', 'alum_asig_curs_grad.asig_curs_grad_id', '=', 'asig_curs_grad.id')
                                                ->join('asignaturas', 'asig_curs_grad.asignatura_id', '=', 'asignaturas.id')
                                                ->where('asignaturas.nombre_asignatura', '=', $calificacion->nombre_asignatura)->get();
                                        ?>
                                        <div class="form-group">
                                            <label for="nombre_col">Asignatura</label>
                                            <div class="input-group">
                                                <select name="asignaturas" class="selectpicker">
                                                    <optgroup label="Actualmente seleccionado">
                                                        <option selected
                                                                value="{{$optionASign[0]['asignatura_id']}}">{{ $calificacion->nombre_asignatura}}</option>
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
                                            <?php
                                            $idCurso = somosAula\curso::select('id')->where('nombre_curso', '=', $calificacion->nombre_curso)->get();
                                            ?>
                                            <label for="nombre_col">Curso:</label>
                                            <div class="input-group">
                                                <select name="curso" class="selectpicker">
                                                    <optgroup label="Actualmente seleccionado">
                                                        <option selected
                                                                value="{{$idCurso[0]['id']}}">{{ $calificacion->nombre_curso}}</option>
                                                    </optgroup>
                                                    <optgroup label="Cursos a seleccionar">
                                                        @foreach($cursos as $curso)
                                                            <option value="{{$curso->id}}">{{$curso->nombre_curso}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            $idGrado = somosAula\grado_educativo::select('id')->where('grado', '=', $calificacion->grado)->get();
                                            ?>
                                            <label for="nombre_col">Grado:</label>
                                            <div class="input-group">
                                                <select name="grado" class="selectpicker">
                                                    <optgroup label="Actualmente seleccionado">
                                                        <option selected
                                                                value="{{$idGrado[0]['id']}}">{{ $calificacion->grado}}</option>
                                                    </optgroup>
                                                    <optgroup label="Cursos a seleccionar">
                                                        @foreach($grados_educativos as $grado_educativo)
                                                            <option value="{{$grado_educativo->id}}">{{$grado_educativo->grado}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="titulo">Nota:</label>
                                            <input type="text" name="nota" class="form-control"
                                                   value="{{$calificacion->nota}}"/>
                                            <div class="text-danger">{{$errors->first('nota')}}</div>
                                        </div>

                                        <div class="form-group">
                                            <label for="titulo">Descripcion:</label>
                                            <input type="textarea" name="descripcion" class="form-control"
                                                   value="{{$calificacion->descripcion}}"/>
                                            <div class="text-danger">{{$errors->first('descripcion')}}</div>
                                        </div>

                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary">Editar calificacion</button>
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
        <a class="btn btn-primary btn-lg RegistPadreAlum" data-toggle="modal" data-target="#añadirCalif"
           href="#entra" role="button" id="login">Calificacion alumno</a>
    </div>
    <div class="modal fade" id="añadirCalif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h2 class="modal-title" id="myModalLabel" aria-label="close">Calificar alumno</h2>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{url('alumnos/calificacion')}}">
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
                            <label for="nombre_col">Curso:</label>
                            <div class="input-group">
                                <select name="curso" class="selectpicker">
                                    @foreach($cursos as $curso)
                                        <option value="{{$curso->id}}">{{$curso->nombre_curso}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nombre_col">Grado:</label>
                            <div class="input-group">
                                <select name="grado" class="selectpicker">
                                    @foreach($grados_educativos as $grado_educativo)
                                        <option value="{{$grado_educativo->id}}">{{$grado_educativo->grado}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="titulo">Nota:</label>
                            <input type="text" name="nota" class="form-control" value=""/>
                            <div class="text-danger">{{$errors->first('nota')}}</div>
                        </div>

                        <div class="form-group">
                            <label for="titulo">Descripcion:</label>
                            <input type="textarea" name="descripcion" class="form-control" value=""/>
                            <div class="text-danger">{{$errors->first('descripcion')}}</div>
                        </div>

                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Enviar calificacion</button>
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
    $calificaciones = somosAula\alum_asig_curs_grad::select()
            ->join('user_rol', 'alum_asig_curs_grad.user_rol_id', '=', 'user_rol.id')
            ->join('users', 'user_rol.user_id', '=', 'users.id')
            ->join('datos_personales', 'users.id', '=', 'datos_personales.user_id')
            ->join('asig_curs_grad', 'alum_asig_curs_grad.asig_curs_grad_id', '=', 'asig_curs_grad.id')
            ->join('asignaturas', 'asig_curs_grad.asignatura_id', '=', 'asignaturas.id')
            ->join('curso_educativo', 'asig_curs_grad.curso_grado_id', '=', 'curso_educativo.id')
            ->join('curso', 'curso_educativo.curso_id', '=', 'curso.id')
            ->join('grado_educativo', 'curso_educativo.grado_id', '=', 'grado_educativo.id')
            ->where('user_rol.id', '=', $the_user_rol_id[0]['id'])->get();

    ?>

    <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true"
           data-pagination="true">
        <thead>
        <tr>
            <th data-field="name" data-halign="center" data-align="center" data-sortable="true">Nombre</th>
            <th data-field="secondname" data-halign="center" data-align="center" data-sortable="true">
                Apellidos
            </th>
            <th data-field="asignatura" data-halign="center" data-align="center" data-sortable="true">Asignatura</th>
            <th data-field="curso" data-halign="center" data-align="center" data-sortable="true">
                Curso
            </th>
            <th data-field="grado" data-halign="center" data-align="center" data-sortable="true">
                Grado
            </th>
            <th data-field="nota" data-halign="center" data-align="center" data-sortable="true">Nota
            </th>
            <th data-field="descripcion" data-halign="center" data-align="center" data-sortable="true">Descripción
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($calificaciones as $calificacion)
            <tr>
                <td>
                    {{ $calificacion->name }}
                </td>

                <td>
                    {{ $calificacion->secondname}}
                    {{ $calificacion->secondname2}}
                </td>
                <td>
                    {{ $calificacion->nombre_asignatura}}
                </td>
                <td>
                    {{ $calificacion->nombre_curso}}
                </td>
                <td>
                    {{ $calificacion->grado}}
                </td>
                @if($calificacion->nota<5)
                    <td>
                        <span style="color: red">{{ $calificacion->nota}}</span>
                    </td>
                @else
                    <td>
                        <span style="color: green"> {{ $calificacion->nota}}</span>
                    </td>
                @endif
                <td>{{$calificacion->descripcion}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

@elseif($the_rol[0]['tipo'] == 'tutor')
    <?php
    $the_user_rol_id = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();
    $calificaciones = somosAula\alum_asig_curs_grad::select()
            ->join('user_rol', 'alum_asig_curs_grad.user_rol_id', '=', 'user_rol.id')
            ->join('users', 'user_rol.user_id', '=', 'users.id')
            ->join('datos_personales', 'users.id', '=', 'datos_personales.user_id')
            ->join('asig_curs_grad', 'alum_asig_curs_grad.asig_curs_grad_id', '=', 'asig_curs_grad.id')
            ->join('asignaturas', 'asig_curs_grad.asignatura_id', '=', 'asignaturas.id')
            ->join('curso_educativo', 'asig_curs_grad.curso_grado_id', '=', 'curso_educativo.id')
            ->join('curso', 'curso_educativo.curso_id', '=', 'curso.id')
            ->join('grado_educativo', 'curso_educativo.grado_id', '=', 'grado_educativo.id')
            ->join('tutorlegal_hijo', 'alum_asig_curs_grad.user_rol_id', '=', 'tutorlegal_hijo.hijo_id')
            ->where('tutorlegal_hijo.tutor_id', '=', $the_user_rol_id[0]['id'])->get()

    ?>

    <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true"
           data-pagination="true">
        <thead>
        <tr>
            <th data-field="name" data-halign="center" data-align="center" data-sortable="true">Nombre</th>
            <th data-field="secondname" data-halign="center" data-align="center" data-sortable="true">
                Apellidos
            </th>
            <th data-field="asignatura" data-halign="center" data-align="center" data-sortable="true">Asignatura</th>
            <th data-field="curso" data-halign="center" data-align="center" data-sortable="true">
                Curso
            </th>
            <th data-field="grado" data-halign="center" data-align="center" data-sortable="true">
                Grado
            </th>
            <th data-field="nota" data-halign="center" data-align="center" data-sortable="true">Nota
            </th>
            <th data-field="descripcion" data-halign="center" data-align="center" data-sortable="true">Descripción
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($calificaciones as $calificacion)
            <tr>
                <td>
                    {{ $calificacion->name }}
                </td>

                <td>
                    {{ $calificacion->secondname}}
                    {{ $calificacion->secondname2}}
                </td>
                <td>
                    {{ $calificacion->nombre_asignatura}}
                </td>
                <td>
                    {{ $calificacion->nombre_curso}}
                </td>
                <td>
                    {{ $calificacion->grado}}
                </td>
                @if($calificacion->nota<5)
                    <td>
                        <span style="color: red">{{ $calificacion->nota}}</span>
                    </td>
                @else
                    <td>
                        <span style="color: green"> {{ $calificacion->nota}}</span>
                    </td>
                @endif
                <td>{{$calificacion->descripcion}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endif