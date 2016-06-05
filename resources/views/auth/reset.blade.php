@extends('layaout.master')

@section('container')
    <div class="container">
        <div class="row cuerpo">
            <div class="col-lg-4">
                <div class="col-md-12">
                </div>
            </div>
            <h1>Resetear el password</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    Los datos introducidos en el formulario son incorrectos.
                </div>
            @endif
            <hr />
            <form method="POST" action="{{url('password/reset')}}">
                {{csrf_field()}}
                <input type="hidden" name="token" value="{{$token}}" />

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" value="{{Input::old('email')}}" />
                    <div class="text-danger">{{$errors->first('email')}}</div>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" name="password" />
                    <div class="text-danger">{{$errors->first('password')}}</div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña:</label>
                    <input type="password" class="form-control" name="password_confirmation" />
                </div>
                <button type="submit" class="btn btn-primary">Reiniciar Contraseña</button>
            </form>
        </div>
    </div>
    <br/>
@stop