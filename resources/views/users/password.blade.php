
    <form method="post" action="{{url('users/updatepassword')}}">
        {{csrf_field()}}
        <div class="form-group">
            <label for="mypassword">Introduce tu actual password:</label>
            <input type="password" name="mypassword" class="form-control">
            <div class="text-danger">{{$errors->first('mypassword')}}</div>
        </div>
        <div class="form-group">
            <label for="password">Introduce tu nuevo password:</label>
            <input type="password" name="password" class="form-control">
            <div class="text-danger">{{$errors->first('password')}}</div>
        </div>
        <div class="form-group">
            <label for="mypassword">Confirma tu nuevo password:</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="pull-right">
        <button type="submit" class="btn btn-primary">Cambiar mi contraseña</button>
        </div>
    </form>
