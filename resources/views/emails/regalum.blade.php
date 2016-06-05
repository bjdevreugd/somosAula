<h1>Alumno {{$data['name']}}</h1>
<p>Este alumno desea asocirse con usted, si reconoce este alumno haga click en el enlace</p>
<a href="{{url()}}/auth/confirmalu/email/{{$data['email']}}/confirm_token/{{$data['confirm_token']}}">Confirmar mi cuenta</a>