@extends('layaout.master')
@section('container')

    @if (Session::has('message'))
        <script type="text/javascript">
            swal({
                title: "",
                text: "{{Session::get('message')}}",
                type: "info",
                confirmButtonText: "OK"
            });
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

                <!--Slider Start-->
        <div class="slider_outer">
            <div id="slider1_container" style="position: relative; margin: 0 auto;
        top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
                <!-- Loading Screen -->
                <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block;
                top: 0px; left: 0px; width: 100%; height: 100%;">
                    </div>
                    <div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center;
                top: 0px; left: 0px; width: 100%; height: 100%;">
                    </div>
                </div>
                <!-- Slides Container -->
                <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1300px;
            height: 500px; overflow: hidden;">
                    <div>
                        <img u="image" src="images/slides/slide2.jpg"/>

                        <div style="position: absolute; width: 480px; height: 120px; top: 30px; left: 30px; padding: 5px;
                    text-align: left; line-height: 60px; text-transform: uppercase; font-size: 50px;
                        color: #FFFFFF;">
                        </div>
                        <div style="position: absolute; width: 480px; height: 120px; top: 300px; left: 30px; padding: 5px;
                    text-align: left; line-height: 36px; font-size: 30px;
                        color: #FFFFFF;">
                        </div>
                    </div>
                    <div>
                        <img u="image" src="images/slides/aula1.jpg"/>
                        <div style="position: absolute; width: 480px; height: 120px; top: 30px; left: 30px; padding: 5px;
                    text-align: left; line-height: 60px; text-transform: uppercase; font-size: 50px;
                        color: #FFFFFF;">
                        </div>
                        <div style="position: absolute; width: 480px; height: 120px; top: 300px; left: 30px; padding: 5px;
                    text-align: left; line-height: 36px; font-size: 30px;
                        color: #FFFFFF;">
                        </div>
                    </div>
                    <div>
                        <img u="image" src="images/slides/aula2.png"/>
                        <div style="position: absolute; width: 480px; height: 120px; top: 30px; left: 30px; padding: 5px;
                    text-align: left; line-height: 60px; text-transform: uppercase; font-size: 50px;
                        color: #FFFFFF;">
                        </div>
                        <div style="position: absolute; width: 480px; height: 120px; top: 300px; left: 30px; padding: 5px;
                    text-align: left; line-height: 36px; font-size: 30px;
                        color: #FFFFFF;">
                        </div>
                    </div>
                </div>


                <!-- bullet navigator container -->
                <div u="navigator" class="jssorb21" style="bottom: 26px; right: 6px;">
                    <!-- bullet navigator item prototype -->
                    <div u="prototype"></div>
                </div>


        <span u="arrowleft" class="jssora21l" style="top: 123px; left: 8px;">
        </span>

        <span u="arrowright" class="jssora21r" style="top: 123px; right: 8px;">
        </span>

            </div>
        </div>
        <div class="modal fade" id="regprofe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h2 class="modal-title" id="myModalLabel" aria-label="close">Registrarse como profesor</h2>
                    </div>
                    <div class="modal-body">
                        @include('auth.register')
                        <br/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="regalum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h2 class="modal-title" id="myModalLabel" aria-label="close">Registrarse como alumno</h2>
                    </div>
                    <div class="modal-body">
                        @include('auth.regAlumno')
                        <br/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="regtutor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h2 class="modal-title" id="myModalLabel" aria-label="close">Registrarse como tutor legal</h2>
                    </div>
                    <div class="modal-body">
                        @include('auth.regPadre')
                        <br/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row cuerpo">
                <div class="col-lg-4">
                    <div class="col-md-12">
                        <h1>¿Eres Profesor?</h1>
                        <hr/>
                        <div class="media">
                            <span>Eres profesor y quieres gestionar las faltas, calificaciones, excursiones, tareas, etc, mediante una aplicación
                            y que al mismo tiempo puedan verlo tus alumnos y sus padres fuera del aula? No esperes más.</span>
                            <a class="btn btn-primary btn-lg RegistPadreAlum" data-toggle="modal"
                               data-target="#regprofe"
                               href="#entra" role="button" id="login">Crea tu cuenta</a>
                        </div>
                        <br/>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="col-md-12">
                        <h1>¿Eres Alumno?</h1>
                        <hr/>
                        <div class="media">
                            <span>Eres alumno de primaria o secundaria y tu profesor te ha dado un código para
                                visualizar tus notas, tareas, excursiones, calificaciones fuera del aula? No espere más.</span>
                            <a class="btn btn-primary btn-lg RegistPadreAlum" data-toggle="modal" data-target="#regalum"
                               href="#entra" role="button">Crea tu cuenta</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="col-md-12">
                        <h1>¿Eres Padre?</h1>
                        <hr/>
                        <div class="media">
                            <span>Eres padre o tutor legal y tienes un hijo utilizando esta aplicación? Registrese gratis y vea las tareas, calificaciones, excursiones e incluso faltas de asistencia de su hijo, no espere más. </span>
                            <a class="btn btn-primary btn-lg RegistPadreAlum" href="#entra" role="button"
                               data-toggle="modal" data-target="#regtutor">Crea tu cuenta</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <br/>
@endsection