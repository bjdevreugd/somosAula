<?php
$misalumnos = somosAula\User::select()
        ->join('datos_personales', 'users.id', '=', 'datos_personales.user_id')
        ->join('user_rol', 'users.id', '=', 'user_rol.user_id')
        ->join('colegio', 'user_rol.id', '=', 'colegio.user_rol_id')
        ->join('rol', 'rol.id', '=', 'user_rol.rol_id')
        ->where('colegio.cod_aula', '=', $colegio[0]['cod_aula'])
        ->where('rol.tipo', '<>', 'profesor')->get();
?>

    <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true" data-pagination="true">
        <thead>
        <tr>
            <th data-field="name" data-align="center" data-sortable="true">Nombre</th>
            <th data-field="secondname" data-align="center" data-sortable="true">
                Apellidos
            </th>
            <th data-field="email" data-align="center" data-sortable="true">Email</th>
            <th data-field="telefono" data-align="center" data-sortable="true">
                Telefono
            </th>
            <th data-field="fechanacimiento" data-align="center" data-sortable="true">
                Fecha de nacimiento
            </th>
            <th data-field="colegio" data-align="center" data-sortable="true">Colegio
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($misalumnos as $alumno)
            <td>
                {{ $alumno->name }}
            </td>

            <td>
                {{ $alumno->secondname}}
                {{ $alumno->secondname2}}
            </td>
            <td>
                {{ $alumno->email}}
            </td>
            <td>
                {{ $alumno->telefono}}
            </td>
            <td>
                {{ $alumno->fechanacimiento}}
            </td>

            <td>{{$alumno->nombre}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
