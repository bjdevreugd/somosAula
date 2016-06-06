<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>somosAula</title>
    <meta name="description" content="">
    <meta name="author" content="BJ.deVreugd">

    <script src="/js/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/js/moment.js" type="text/javascript"></script>
    <script src="/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/js/bootstrap-table.js" type="text/javascript"></script>
    <script src="/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="/js/jssor.js" type="text/javascript"></script>
    <script src="/js/jssor.slider.js" type="text/javascript"></script>
    <script src="/js/slider.js" type="text/javascript"></script>
    <script src="/js/sweetalert.min.js" type="text/javascript"></script>


    <link rel="stylesheet" type="text/css" href="/css/sweetalert.css"/>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-table.css"/>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-select.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.css"/>
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="/css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="/css/style-animate.css"/>
    <link rel="stylesheet" type="text/css" href="/css/slider.css"/>
    <link rel="stylesheet" type="text/css" href="/css/custom.css"/>
    <link rel="stylesheet" type="text/css" href="/css/datepicker.css"/>

</head>

<body>
<!--Top Header-->
<header class="header">
    <div class="container" style="margin-top: 10px;">
        <div class="row">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse"
                            data-target="#main-nav"><span class="sr-only">Toggle navigation</span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                    </button>
                    <a href="/index"><img src="/images/logo.png" id="logo"> </a></div>
                <b id="tagline"><img src="/images/lineavertical.png"> Sigue más allá del Aula</b>
                <div id="main-nav" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav" id="mainNav">
                        <li><a href="{{url('/inicio')}}">Inicio</a></li>
                        <li><a href="{{url('/NuestroServicio')}}">Nuestro servicio</a></li>
                        <li><a href="{{url('/QuienesSomos')}}">¿Quienes somos?</a></li>
                        <li><a href="{{url('/contact')}}">Contacto</a></li>
                        @if(!\Auth::check())

                            <li>
                                <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#entra"
                                   href="#entra" role="button" id="login">entra</a>
                            </li>

                        @else
                            <?php
                            $minombre = \somosAula\datosPersonales::select()->where('user_id','=', \Auth::user()->id)->get();
                            ?>
                            <div class="btn-group">
                                <li class="dropdown-toggle" data-toggle="dropdown">
                                    <a style="color: orange;" href="{{url('user')}}"><i
                                                class="glyphicon glyphicon-user"> </i>
                                       @if($minombre[0]['name'] == null){{\Auth::user()->name}}
                                    @else
                                            {{$minombre[0]['name']}}
                                        @endif
                                    </a>
                                </li>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{url('user')}}"><i class="fa fa-columns"></i> Panel de control</a>
                                    </li>
                                    <li><a href="{{url('user/panel')}}"><i class="glyphicon glyphicon-cog"></i>
                                            Configuracion</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{url('auth/logout')}}"><i class="glyphicon glyphicon-off"></i>
                                            Salir</a></li>
                                </ul>
                            </div>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<div id="cuerpo">
    <div class="modal fade" id="entra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" aria-label="close">Iniciar sesión</h4>
                </div>
                <div class="modal-body">
                    @include('auth.login')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('container')


</div>
<div class="container">
    <!--Footer Start-->
    <footer>
        <hr/>
        <br/>
        <div class="col-lg-4">
            <div class="fb-page" data-href="https://www.facebook.com/themesrefinery" data-hide-cover="false"
                 data-show-facepile="true" data-show-posts="false">
                <div class="fb-xfbml-parse-ignore">
                    <blockquote cite="https://www.facebook.com/themesrefinery"><img src="/images/telephone.png">
                        665-86-76-11
                    </blockquote>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="fb-page" data-href="https://www.facebook.com/themesrefinery" data-hide-cover="false"
                 data-show-facepile="true" data-show-posts="false">
                <div class="fb-xfbml-parse-ignore">
                    <blockquote cite="https://www.facebook.com/themesrefinery"><img src="/images/mapoint.png"> C/ Miquel
                        Porcel, nº 83, 07014
                    </blockquote>
                </div>
            </div>


        </div>
        <div class="col-lg-4">
            <div class="fb-page" data-href="https://www.facebook.com/themesrefinery" data-hide-cover="false"
                 data-show-facepile="true" data-show-posts="false">
                <div class="fb-xfbml-parse-ignore">
                    <blockquote cite="https://www.facebook.com/themesrefinery"><img src="/images/mail.png">
                        Hola@somosaula.com
                    </blockquote>
                </div>
            </div>

        </div>

        <div class="col-lg-12 top2 bottom2">
            <div class="text-center">&copy; 2016 <a href="http://www.themesrefinery.net/"><i class="fa  fa-file-code">BJ.deVreugd</i></a>
            </div>
        </div>
    </footer>
    <!--Footer End-->
</div>
</body>
</html>
