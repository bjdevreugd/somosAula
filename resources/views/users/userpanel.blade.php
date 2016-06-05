@extends('layaout.master')
@section('container')
    <?php
    $the_userrol = somosAula\userRol::select()->where('user_id', '=', \Auth::user()->id)->get();
    $the_rol = somosAula\Rol::select()->where('id', '=', $the_userrol[0]['rol_id'])->get();
    $the_datos = somosAula\datosPersonales::select()->where('user_id', '=', \Auth::user()->id)->get();
    $the_colegio = somosAula\colegio::select()->where('user_rol_id', '=', $the_userrol[0]['id'])->get();
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
                                    Hola {{$the_datos[0]['name']}}
                                </div>
                                <div class="profile-usertitle-job">



                                    {{$the_rol[0]['tipo']}}
                                </div>
                            </div>
                            <div class="profile-userbuttons">

                            </div>
                            <!-- END SIDEBAR BUTTONS -->
                            <!-- SIDEBAR MENU -->
                            <div class="profile-usermenu">
                                <ul class="nav nav-stacked">

                                    <li class="nav-item">
                                        <a href="{{url('user')}}">
                                            <i class="glyphicon glyphicon-home"></i>
                                            Inicio </a>
                                    </li>

                                    <li class="active"><a data-toggle="tab" href="#updatedatos">
                                            <i class="glyphicon glyphicon-user"></i>Configurar cuenta </a></li>
                                    <li><a data-toggle="tab" href="#imgperfil"><i
                                                    class="glyphicon glyphicon-picture"></i>
                                            Cambiar foto de perfil </a></li>
                                    <li><a data-toggle="tab" href="#cambiarcontraseña"> <i
                                                    class="glyphicon glyphicon-lock"></i>
                                            Cambiar contraseña</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="profile-content table-responsive">
                            <div class="tab-content">
                                <div id="updatedatos" class="tab-pane fade in active">

                                    <h1 class="col-lg-offset-3">Actualizar datos personales</h1>
                                    <div class="row cuerpo">
                                        <div class="col-lg-2">
                                            <div class="col-md-12">
                                            </div>
                                        </div>
                                        @if (Session::has('message'))
                                            <div class="text-danger">
                                                {{Session::get('message')}}
                                            </div>
                                        @endif
                                        <br/>
                                        <hr/>
                                        <br/>
                                        <div class="col-md-6 ">
                                            <div class="col-md-12">
                                                @include('users.updatedatospersonales')
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="col-md-12">
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div id="imgperfil" class="tab-pane fade">
                                    <h1 class="col-lg-offset-3">Cambiar foto de perfil</h1>
                                    <hr/>
                                    <br/>
                                    @include('users.imgperfil')
                                </div>


                                <div id="cambiarcontraseña" class="tab-pane fade">
                                    <h1 class="col-lg-offset-3">Cambiar mi contraseña</h1>
                                    @if (Session::has('message'))
                                        <div class="text-danger">
                                            {{Session::get('message')}}
                                        </div>
                                    @endif
                                    <hr/>
                                    <br/>
                                    <div class="col-md-5 col-lg-offset-3">
                                        @include('users.password')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
        </div>
    </div>
    <script src="/js/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap-datepicker.js" type="text/javascript"></script>

    <script>
        $(function () {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd'
            }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });
        });
    </script>
@stop