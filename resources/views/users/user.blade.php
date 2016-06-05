@extends('layaout.master')
@section('container')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#prueba").click(function(){
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this lorem ipsum!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                });
            });
        });
    </script>
    <?php
    $the_userrol = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();
    $the_rol = somosAula\Rol::select()->where('id', '=', $the_userrol[0]['rol_id'])->get();
    $users = somosAula\datosPersonales::select()->where('user_id', '=', \Auth::user()->id)->get();
    $colegio = somosAula\Colegio::select()->where('user_rol_id', '=', $the_userrol[0]['id'])->get();

    ?>
    <div class="container">
        @if (Session::has('message'))
            <script type="text/javascript">
                swal({title: "",
                    text: "{{Session::get('message')}}",
                    type: "info",
                    confirmButtonText: "OK"});
            </script>
        @endif
        @if (Session::has('error'))
            <script type="text/javascript">
                swal({
                    title: "Error!",
                    text: "{{Session::get('error')}}",
                    type: "error",
                    confirmButtonText: "OK"
                });
            </script>
        @endif
            @if (Session::has('success'))
                <script type="text/javascript">
                    swal({
                        title: "",
                        text: "{{Session::get('success')}}",
                        type: "success",
                        confirmButtonText: "OK"
                    });
                </script>
            @endif
        <div class="row cuerpo">
            <div class="container">
                <div class="row profile">
                    <div class="col-md-3">
                        <div class="profile-sidebar">
                            <div class="profile-userpic">
                                <img src='{{url(Auth::user()->imgperfil)}}' class='img-responsive'/>
                            </div>
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">
                                    Hola {{$users[0]['name']}}
                                </div>
                                <div class="profile-usertitle-job">


                                    {{$the_rol[0]['tipo']}}
                                </div>
                                <span class="alert-info">@if($the_rol[0]['tipo']=='tutor') @else Su código es: {{$colegio[0]['cod_aula']}} @endif</span>
                            </div>
                            <div class="profile-usermenu">
                                <ul class="nav nav-stacked">

                                    <li class="nav-item">
                                        <a href="{{url('user')}}">
                                            <i class="glyphicon glyphicon-home"></i>
                                            Inicio </a>
                                    </li>
                                    @if($the_rol[0]['tipo'] == 'profesor')
                                        <li class="active"><a data-toggle="tab" href="#misalumnos">
                                                <i class="fa fa-users"></i>Mis alumnos </a></li>
                                    @else
                                        <li class="active"><a data-toggle="tab" href="#misalumnos">
                                                <i class="fa fa-dashcube"></i>Muro</a></li>

                                    @endif
                                    <li><a data-toggle="tab" href="#tareas"><i
                                                    class="fa fa-book"></i>
                                            Tareas </a></li>
                                    <li><a data-toggle="tab" href="#asistencias"> <i
                                                    class="fa fa-list-alt"></i>
                                            Asistencia</a></li>
                                    <li><a data-toggle="tab" href="#calificaciones"> <i
                                                    class="fa fa-th-list"></i>
                                            Calificaciones</a></li>
                                    <li><a data-toggle="tab" href="#excursiones"> <i
                                                    class="fa fa-bus"></i>
                                            Excursiones</a></li>
                                    <li><a data-toggle="tab" href="#mensajes"> <i
                                                    class="glyphicon glyphicon-comment"></i>
                                            Mensajeria</a></li>
                                    <li><a data-toggle="tab" href="#tutorias"> <i
                                                    class="glyphicon glyphicon-calendar"></i>
                                            Tutoria</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="profile-content">
                            <div class="tab-content">
                                <div id="misalumnos" class="tab-pane fade in active">
                                    @if($the_rol[0]['tipo'] == 'profesor')
                                        @include('alumnos.misalumnos')
                                    @else
                                        @include('alumnos.muro')
                                    @endif
                                </div>
                                <div id="tareas" class="tab-pane fade">
                                    @include('alumnos.tareas')
                                </div>
                                <div id="asistencias" class="tab-pane fade">
                                    @include('alumnos.asistencia')
                                </div>
                                <div id="excursiones" class="tab-pane fade">
                                    @include('alumnos.excursiones')
                                </div>
                                <div id="calificaciones" class="tab-pane fade">
                                    @include('alumnos.calificaciones')
                                </div>
                                <div id="mensajes" class="tab-pane fade">

                                </div>
                                <div id="tutorias" class="tab-pane fade">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>
@stop