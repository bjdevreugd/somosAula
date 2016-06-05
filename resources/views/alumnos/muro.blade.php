@if($the_rol[0]['tipo'] == 'alumno')
    <?php
    $the_user_rol_id = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();
    $tarea = somosAula\user_tarea::select()
            ->join('user_rol', 'user_tarea.user_rol_id', '=', 'user_rol.id')
            ->join('datos_personales', 'user_rol.user_id', '=', 'datos_personales.user_id')
            ->join('tarea', 'user_tarea.tarea_id', '=', 'tarea.id')
            ->join('asignaturas', 'tarea.asignatura_id', '=', 'asignaturas.id')
            ->where('user_rol.id', '=', $the_user_rol_id[0]['id'])->orderBy('fecha_fin', 'desc')->get();

    $asistencia = somosAula\user_asistencia::select()
            ->join('user_rol', 'user_asistencia.user_rol_id', '=', 'user_rol.id')
            ->join('rol', 'user_rol.rol_id', '=', 'rol.id')
            ->join('asistencia', 'user_asistencia.asistencia_id', '=', 'asistencia.id')
            ->join('asignaturas', 'asistencia.asignatura_id', '=', 'asignaturas.id')
            ->join('users', 'user_rol.user_id', '=', 'users.id')
            ->join('datos_personales', 'users.id', '=', 'datos_personales.user_id')
            ->where('user_rol.id', '=', $the_user_rol_id[0]['id'])->orderBy('asistencia.fecha_clase', 'desc')->get();

    $cod_aula_profe = somosAula\Colegio::select()
            ->join('user_rol', 'colegio.user_rol_id', '=', 'user_rol.id')
            ->where('colegio.user_rol_id', '=', $the_user_rol_id[0]['id'])->get();

    $calificacionAsc = somosAula\alum_asig_curs_grad::select()
            ->join('asig_curs_grad', 'alum_asig_curs_grad.asig_curs_grad_id', '=', 'asig_curs_grad.id')
            ->join('asignaturas', 'asig_curs_grad.asignatura_id', '=', 'asignaturas.id')
            ->join('curso_educativo', 'asig_curs_grad.curso_grado_id', '=', 'curso_educativo.id')
            ->join('curso', 'curso_educativo.curso_id', '=', 'curso.id')
            ->join('grado_educativo', 'curso_educativo.grado_id', '=', 'grado_educativo.id')
            ->join('colegio', 'alum_asig_curs_grad.user_rol_id', '=', 'colegio.user_rol_id')
            ->where('colegio.cod_aula', '=', $cod_aula_profe[0]['cod_aula'])->orderBy('nota', 'asc')->get();


    $calificacionDes = somosAula\alum_asig_curs_grad::select()
            ->join('asig_curs_grad', 'alum_asig_curs_grad.asig_curs_grad_id', '=', 'asig_curs_grad.id')
            ->join('asignaturas', 'asig_curs_grad.asignatura_id', '=', 'asignaturas.id')
            ->join('curso_educativo', 'asig_curs_grad.curso_grado_id', '=', 'curso_educativo.id')
            ->join('curso', 'curso_educativo.curso_id', '=', 'curso.id')
            ->join('grado_educativo', 'curso_educativo.grado_id', '=', 'grado_educativo.id')
            ->join('colegio', 'alum_asig_curs_grad.user_rol_id', '=', 'colegio.user_rol_id')
            ->where('colegio.cod_aula', '=', $cod_aula_profe[0]['cod_aula'])->orderBy('nota', 'desc')->get();

    $excursion = somosAula\user_excursion::select()
            ->join('user_rol', 'user_excursion.user_rol_id', '=', 'user_rol.id')
            ->join('excursion', 'user_excursion.excursion_id', '=', 'excursion.id')
            ->join('colegio', 'user_excursion.user_rol_id', '=', 'colegio.user_rol_id')
            ->where('colegio.cod_aula', '=', $cod_aula_profe[0]['cod_aula'])->get();

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-content">
                        <h3>Tarea más reciente</h3>
                        <h4>{{ $tarea[0]['titulo'] }}</h4>
                        <p>{{ $tarea[0]['descripcion'] }}</p>
                    </div>

                    <div class="card-action">
                        <i class="fa fa-clock-o"> {{ $tarea[0]['fecha_fin'] }}</i>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-content">
                        <h3>Asistencia más reciente</h3>
                        <h4>{{ $asistencia[0]['nombre_asignatura'] }}</h4>
                        @if($asistencia[0]['asiste'] == 0)
                            <p style="color: red;">No presentado</p>
                        @else
                            <p>Presentado</p>

                        @endif
                    </div>

                    <div class="card-action">
                        <i class="fa fa-clock-o"> {{ $asistencia[0]['fecha_clase'] }}</i>
                    </div>
                </div>
            </div>
        </div>

        <br/>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-content">
                        <h3>Peor nota</h3>
                        <h4>{{ $calificacionAsc[0]['nombre_asignatura'] }}</h4>
                        <p>{{ $calificacionAsc[0]['nota'] }}</p>
                    </div>

                    <div class="card-action">
                        <span>{{ $calificacionAsc[0]['nombre_curso'] }}</span> de
                        <span>{{ $calificacionAsc[0]['grado'] }}</span>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-content">
                        <h3>Mejor nota</h3>
                        <h4>{{ $calificacionDes[0]['nombre_asignatura'] }}</h4>
                        <p>{{ $calificacionDes[0]['nota'] }}</p>
                    </div>

                    <div class="card-action">
                        <span>{{ $calificacionDes[0]['nombre_curso'] }}</span> de
                        <span>{{ $calificacionDes[0]['grado'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <br/>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-content">
                        <h3>Próxima excursión</h3>
                        <h4>{{ $excursion[0]['titulo'] }}</h4>
                        <p>{{ $excursion[0]['descripcion'] }}</p>
                        <p>importe de la excursión: {{ $excursion[0]['importe'] }}</p>
                    </div>

                    <div class="card-action">
                        <i class="fa fa-clock-o"> {{ $excursion[0]['fecha_excursion'] }}</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($the_rol[0]['tipo'] == 'tutor')
    <?php
    $the_user_rol_id = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();
    $tarea = somosAula\user_tarea::select()
            ->join('user_rol', 'user_tarea.user_rol_id', '=', 'user_rol.id')
            ->join('datos_personales', 'user_rol.user_id', '=', 'datos_personales.user_id')
            ->join('tarea', 'user_tarea.tarea_id', '=', 'tarea.id')
            ->join('asignaturas', 'tarea.asignatura_id', '=', 'asignaturas.id')
            ->join('tutorlegal_hijo', 'user_tarea.user_rol_id', '=', 'tutorlegal_hijo.hijo_id')
            ->where('tutorlegal_hijo.tutor_id', '=', $the_user_rol_id[0]['id'])->orderBy('fecha_fin', 'desc')->get();

    $asistencia = somosAula\user_asistencia::select()
            ->join('user_rol', 'user_asistencia.user_rol_id', '=', 'user_rol.id')
            ->join('rol', 'user_rol.rol_id', '=', 'rol.id')
            ->join('asistencia', 'user_asistencia.asistencia_id', '=', 'asistencia.id')
            ->join('asignaturas', 'asistencia.asignatura_id', '=', 'asignaturas.id')
            ->join('users', 'user_rol.user_id', '=', 'users.id')
            ->join('datos_personales', 'users.id', '=', 'datos_personales.user_id')
            ->join('tutorlegal_hijo', 'user_asistencia.user_rol_id', '=', 'tutorlegal_hijo.hijo_id')
            ->where('tutorlegal_hijo.tutor_id', '=', $the_user_rol_id[0]['id'])->orderBy('fecha_clase', 'desc')->get();

    $calificacionAsc = somosAula\alum_asig_curs_grad::select()
            ->join('user_rol', 'alum_asig_curs_grad.user_rol_id', '=', 'user_rol.id')
            ->join('users', 'user_rol.user_id', '=', 'users.id')
            ->join('datos_personales', 'users.id', '=', 'datos_personales.user_id')
            ->join('asig_curs_grad', 'alum_asig_curs_grad.asig_curs_grad_id', '=', 'asig_curs_grad.id')
            ->join('asignaturas', 'asig_curs_grad.asignatura_id', '=', 'asignaturas.id')
            ->join('curso_educativo', 'asig_curs_grad.curso_grado_id', '=', 'curso_educativo.id')
            ->join('curso', 'curso_educativo.curso_id', '=', 'curso.id')
            ->join('grado_educativo', 'curso_educativo.grado_id', '=', 'grado_educativo.id')
            ->join('tutorlegal_hijo', 'alum_asig_curs_grad.user_rol_id', '=', 'tutorlegal_hijo.hijo_id')
            ->where('tutorlegal_hijo.tutor_id', '=', $the_user_rol_id[0]['id'])->orderBy('nota', 'asc')->get();

    $calificacionDes = somosAula\alum_asig_curs_grad::select()
            ->join('user_rol', 'alum_asig_curs_grad.user_rol_id', '=', 'user_rol.id')
            ->join('users', 'user_rol.user_id', '=', 'users.id')
            ->join('datos_personales', 'users.id', '=', 'datos_personales.user_id')
            ->join('asig_curs_grad', 'alum_asig_curs_grad.asig_curs_grad_id', '=', 'asig_curs_grad.id')
            ->join('asignaturas', 'asig_curs_grad.asignatura_id', '=', 'asignaturas.id')
            ->join('curso_educativo', 'asig_curs_grad.curso_grado_id', '=', 'curso_educativo.id')
            ->join('curso', 'curso_educativo.curso_id', '=', 'curso.id')
            ->join('grado_educativo', 'curso_educativo.grado_id', '=', 'grado_educativo.id')
            ->join('tutorlegal_hijo', 'alum_asig_curs_grad.user_rol_id', '=', 'tutorlegal_hijo.hijo_id')
            ->where('tutorlegal_hijo.tutor_id', '=', $the_user_rol_id[0]['id'])->orderBy('nota', 'desc')->get();

    $excursion = somosAula\user_excursion::select()
            ->join('user_rol', 'user_excursion.user_rol_id', '=', 'user_rol.id')
            ->join('excursion', 'user_excursion.excursion_id', '=', 'excursion.id')
            ->join('tutorlegal_hijo', 'user_excursion.user_rol_id', '=', 'tutorlegal_hijo.hijo_id')
            ->where('tutorlegal_hijo.tutor_id', '=', $the_user_rol_id[0]['id'])->get();
    ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <h3>Tarea más reciente</h3>
                        <h4>{{ $tarea[0]['titulo'] }}</h4>
                        <p>{{ $tarea[0]['descripcion'] }}</p>
                    </div>

                    <div class="card-action">
                        <i class="fa fa-clock-o"> {{ $tarea[0]['fecha_fin'] }}</i>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <h3>Asistencia más reciente</h3>
                        <h4>{{ $asistencia[0]['nombre_asignatura'] }}</h4>
                        @if($asistencia[0]['asiste'] == 0)
                            <p style="color: red;">No presentado</p>
                        @else
                            <p>Presentado</p>

                        @endif
                    </div>

                    <div class="card-action">
                        <i class="fa fa-clock-o"> {{ $asistencia[0]['fecha_clase'] }}</i>
                    </div>
                </div>
            </div>


        <br/>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <h3>Peor nota</h3>
                        <h4>{{ $calificacionAsc[0]['nombre_asignatura'] }}</h4>
                        <p>{{ $calificacionAsc[0]['nota'] }}</p>
                    </div>

                    <div class="card-action">
                        <span>{{ $calificacionAsc[0]['nombre_curso'] }}</span> de
                        <span>{{ $calificacionAsc[0]['grado'] }}</span>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <h3>Mejor nota</h3>
                        <h4>{{ $calificacionDes[0]['nombre_asignatura'] }}</h4>
                        <p>{{ $calificacionDes[0]['nota'] }}</p>
                    </div>

                    <div class="card-action">
                        <span>{{ $calificacionDes[0]['nombre_curso'] }}</span> de
                        <span>{{ $calificacionDes[0]['grado'] }}</span>
                    </div>
                </div>
            </div>


        <br/>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <h3>Próxima excursión</h3>
                        <h4>{{ $excursion[0]['titulo'] }}</h4>
                        <p>{{ $excursion[0]['descripcion'] }}</p>
                        <p>importe de la excursión: {{ $excursion[0]['importe'] }}</p>
                    </div>

                    <div class="card-action">
                        <i class="fa fa-clock-o"> {{ $excursion[0]['fecha_excursion'] }}</i>
                    </div>
                </div>
            </div>

@endif