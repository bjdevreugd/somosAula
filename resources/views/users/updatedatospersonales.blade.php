<form method="post" action="{{url('users/updatedatospersonales')}}">
    {{csrf_field()}}

    <div class="form-group">
        <label for="nombre_col">Nombre del colegio:</label>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-education"></i>
            </div>
            <input type="text" name="nombre_col" class="form-control"
                   value="{{$the_colegio[0]['nombre']}}">
            <div class="text-danger">{{$errors->first('nombre_col')}}</div>
        </div>
    </div>

    <div class="form-group">
        <label for="name">Nombre:</label>
        <input type="text" name="name" class="form-control"
               value="{{$the_datos[0]['name']}}"/>
        <div class="text-danger">{{$errors->first('name')}}</div>
    </div>
    <div class="form-group">
        <label for="secondname">Primer apellido:</label>
        <input type="text" name="secondname" class="form-control"
               value="{{$the_datos[0]['secondname']}}">
        <div class="text-danger">{{$errors->first('secondname')}}</div>
    </div>
    <div class="form-group">
        <label for="secondname2">Segundo apellido:</label>
        <input type="text" name="secondname2" class="form-control"
               value="{{$the_datos[0]['secondname2']}}">
        <div class="text-danger">{{$errors->first('secondname2')}}</div>
    </div>
    </div>
    </div>

    <div class="col-md-6">
        <div class="col-md-12">
            <div class="form-group">
                <label for="DNI">DNI:</label>
                <input type="text" name="DNI" class="form-control"
                       value="{{$the_datos[0]['DNI']}}">
                <div class="text-danger">{{$errors->first('DNI')}}</div>
            </div>

            <div class="form-group">
                <label for="email">email:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-envelope">
                        </i>
                    </div>
                    <input type="email" name="email" class="form-control"
                           value="{{$the_datos[0]['email']}}">
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
                    <input type="tel" name="telefono" class="form-control"
                           value="{{$the_datos[0]['telefono']}}">
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
                    <input class="form-control datepicker" id="date"
                           name="fechanacimiento"
                           value="{{$the_datos[0]['fechanacimiento']}}"
                           type="text"/>
                    <div class="text-danger">{{$errors->first('fechanacimiento')}}</div>
                </div>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary">Actualizar datos
                </button>
            </div>
</form>