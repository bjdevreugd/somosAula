
<!--/* <div class="container text-danger">
            @if (Session::has('message'))
            {{Session::get('message')}}
            @endif
        </div>*/-->

    <form method="POST" action="{{url('auth/register')}}">
        {!! csrf_field() !!}

        <div class='form-group'>
            <label for="name">Nombre:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
            <div class="text-danger">{{$errors->first('name')}}</div>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-envelope"></i>
                </div>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
            <div class="text-danger">{{$errors->first('email')}}</div>
        </div>
</div>
        <div class="form-group">
            <label for="password">Password:</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-lock"></i>
                </div>
            <input type="password" class="form-control" name="password" />
            <div class="text-danger">{{$errors->first('password')}}</div>
        </div>
</div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar Password:</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-lock"></i>
                </div>
            <input type="password" class="form-control" name="password_confirmation" />
        </div>
</div>
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">Registrarse</button>
            <br/>
            <br/>
        </div>
    </form>
    <br/>
