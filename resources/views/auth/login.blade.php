
       <!--/* <div class="container text-danger">
            @if (Session::has('message'))
                {{Session::get('message')}}
            @endif
        </div>*/-->

                    <form method="post" action="{{url('auth/login')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-envelope"></i>
                                </div>
                            <input type="email" name="email" class="form-control" value="{{Input::old('email')}}"/>
                            <div class="text-danger">{{$errors->first('email')}}</div>
                        </div>
                            </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-lock"></i>
                                </div>
                            <input type="password" name="password" class="form-control"/>
                            <div class="text-danger">{{$errors->first('password')}}</div>
                        </div>
                            </div>
                        <div class="form-group">
                            <label for="remember">No cerrar sesión:</label>
                            <input type="checkbox" name="remember"/>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Iniciar sesión <i class="glyphicon glyphicon-log-in"> </i> </button>
                            <br/>
                        </div>
                        <a href='{{url("password/email")}}'>Olvidé mi contraseña</a><br/>
                       <!-- <a href="{{url('auth/register')}}">Registrarme como profesor</a></br/>
                        <a href="{{url('auth/regAlumno')}}">Registrarme como alumno</a>-->
                    </form>
    <br/>