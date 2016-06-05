@extends('layaout.master')
@section('container')
    <div class="container">
        <h1 class="h1">Sólo una cosa más, introduzca sus datos</h1>
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
            <hr/>
            <div class="col-lg-6">
                <div class="col-md-12">
                    <form method="post" action="{{url('users/datospersonales')}}">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="nombre_col">Nombre del colegio:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-education"></i>
                                </div>
                                <input type="text" name="nombre_col" class="form-control">
                                <div class="text-danger">{{$errors->first('nombre_col')}}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" class="form-control" value=""/>
                            <div class="text-danger">{{$errors->first('name')}}</div>
                        </div>
                        <div class="form-group">
                            <label for="secondname">Primer apellido:</label>
                            <input type="text" name="secondname" class="form-control">
                            <div class="text-danger">{{$errors->first('secondname')}}</div>
                        </div>

                        <div class="form-group">
                            <label for="secondname2">Segundo apellido:</label>
                            <input type="text" name="secondname2" class="form-control">
                            <div class="text-danger">{{$errors->first('secondname2')}}</div>
                        </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="DNI">DNI:</label>
                        <input type="text" name="DNI" class="form-control">
                        <div class="text-danger">{{$errors->first('DNI')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="email">email:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-envelope">
                                </i>
                            </div>
                            <input type="email" name="email" class="form-control" value="">
                            <div class="text-danger">{{$errors->first('email')}}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-phone-alt">
                                </i>
                            </div>
                            <input type="tel" name="telefono" class="form-control">
                            <div class="text-danger">{{$errors->first('telefono')}}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fechanacimiento">Fecha de nacimiento:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar">
                                </i>
                            </div>
                            <input class="form-control datepicker" id="date" name="fechanacimiento"
                                   placeholder="dd/MM/yyyy" type="text"/>
                            <div class="text-danger">{{$errors->first('fechanacimiento')}}</div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">Insertar datos</button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="col-md-12">
                </div>
            </div>
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
