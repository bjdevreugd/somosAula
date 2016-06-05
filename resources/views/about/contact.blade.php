@extends('layaout.master')
@section('container')
    <div class="container">
        <div class="row cuerpo">
            <div class="col-lg-6">
                <div class="col-md-12">
                    <h2>Contacta con nosotros</h2>
                    @if(Session::has('message'))
                        <div class="alert alert-info">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    {!! Form::open(array('route' => 'contact_store', 'class' => 'form')) !!}
                    @if(\Auth::check())
                        <div class="form-group">
                            {!! Form::label('Tu nombre') !!}
                            {!! Form::text('name', \Auth::user()->name,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'Introduzca su nombre')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Email') !!}
                            {!! Form::text('email', \Auth::user()->email,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'Introduzca su email')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Tema') !!}
                            {!! Form::text('tema', null,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'Introduce un tema')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Escriba su mensaje') !!}
                            {!! Form::textarea('message', null,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'Introduzca un mensaje')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Enviar',
                              array('class'=>'btn btn-primary btn-lg')) !!}
                        </div>
                    @else
                        <div class="form-group">
                            {!! Form::label('Tu nombre') !!}
                            {!! Form::text('name', null,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'Introduzca su nombre')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Email') !!}
                            {!! Form::text('email', null,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'Introduzca su email')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Tema') !!}
                            {!! Form::text('tema', null,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'Introduce un tema')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Escriba su mensaje') !!}
                            {!! Form::textarea('message', null,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'Introduzca un mensaje')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Enviar',
                              array('class'=>'btn btn-primary btn-lg')) !!}
                        </div>
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="col-md-12">
                    <h2>Nuestra ubicación</h2>
                    <br/>
                    <iframe width="500" height="200" frameborder="0" style="border:0"
                            src="https://www.google.com/maps/embed/v1/place?q=Miguel%20porcel%2083%20palma&key=AIzaSyAsPwLfRJnZVmHlIHY59XYuuu8P-CuOnrI"
                            allowfullscreen></iframe>
                    <br/> <br/>
                    <span class="label label-info">Telefono: 971-85-95-9</span><br/> <br/>
                    <span class="label label-info">Móvil: 665-86-76-11</span><br/> <br/>
                    <span class="label label-info">Fax: 971-87-85-95</span><br/> <br/>
                    <span class="label label-info">Email: Hola@somosaula.com</span><br/> <br/>
                </div>
            </div>
        </div>
    </div>
@endsection