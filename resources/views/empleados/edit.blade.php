<!-- Heredar el master page en la vista -->
@extends('layouts.master')

<!-- Inicio de la vista -->

@section('estilos-particulares')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('j-deps')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $( function() {
            $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
        } );
    </script>
@endsection

@section('contenido_vistas')

<form class="form-horizontal" method="post" action="{{ url('empleados/'.$empleado->EmployeeId) }}">
    @method('PUT')

    @csrf
    @if(session("mensaje"))
        <p class="alert alert-success">{{ session("mensaje") }}</p>
    @endif
    <fieldset>
        <!-- Form Name -->
        <legend>Editar Empleado: {{ $empleado->FirstName }} {{ $empleado->LastName }}</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Nombre</label>  
            <div class="col-md-5">
                <input value="{{ $empleado->FirstName }}" id="nombre" name="nombre" type="text" placeholder="Nombre empleado" class="form-control input-md">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="apellido">Apellido</label>  
            <div class="col-md-5">
                <input value="{{ $empleado->LastName }}" id="apellido" name="apellido" type="text" placeholder="Apellido empleado" class="form-control input-md">
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="selectbasic">Jefe Directo</label>
            <div class="col-md-5">
                <select id="selectbasic" name="selectjefe" class="form-control">
                    <!-- Recorrer los jefes-->
                    @if( $empleado->jefe_directo()->count() === 0 )
                            <option selected value="">..Seleccione jefe directo</option>
                            @foreach($jefes as $j)
                                <option value="{{ $j->EmployeeId }}">{{ $j->LastName }} {{ $j->FirstName }}</option>
                            @endforeach
                    @else
                        <option selected value="">..Seleccione jefe directo</option>
                        @foreach($jefes as $j)
                            @if($j->EmployeeId  === $empleado->jefe_directo()->first()->EmployeeId )
                                <option  selected value="{{ $j->EmployeeId }}">{{ $j->LastName }} {{ $j->FirstName }}</option>
                            @else
                            <option value="{{ $j->EmployeeId }}">{{ $j->LastName }} {{ $j->FirstName }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
                <p>{{ $errors->first('jefe') }}</p>
            </div>
        </div>
        
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="selectbasic">Cargo</label>
            <div class="col-md-5">
                <select id="selectbasic" name="selectcargo" class="form-control">
                    @foreach($cargos as $c)
                        @if($empleado->Title === $c->Title)
                        <option value="{{ $c->Title }}" selected>{{ $c->Title }}</option>
                        @else
                        <option value="{{ $c->Title }}">{{ $c->Title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="fechac">Fecha de contratacion</label>  
            <div class="col-md-5">
                <input value="{{ $empleado->HireDate->format('Y-m-d') }}" id="fecha" name="fechac" type="text" placeholder="Contratacion" class="datepicker form-control input-md">        
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Fecha">Fecha de naciemiento</label>  
            <div class="col-md-5">
                <input value="{{ $empleado->BirthDate->format('Y-m-d') }}" id="fechan" name="fechan" type="text" placeholder="Fecha" class="datepicker form-control input-md">       
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="direccion">Direccion</label>  
            <div class="col-md-5">
                <input value="{{ $empleado->Address }}" id="direccion" name="direccion" type="text" placeholder="Direccion" class="form-control input-md">   
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-2 control-label" for="ciudad">Ciudad</label>  
            <div class="col-md-5">
                <input value="{{ $empleado->City }}" id="ciudad" name="ciudad" type="text" placeholder="Ciudad" class="form-control input-md">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Email">Email</label>  
            <div class="col-md-5">
                <input value="{{ $empleado->Email }}" id="Email" name="email" type="text" placeholder="correo electronico" class="form-control input-md">
            </div>
        </div>



        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="enviar"></label>
            <div class="col-md-4">
                <button id="enviar" name="enviar" class="btn btn-primary">Enviar</button>
            </div>
        </div>

    </fieldset>
</form>




<!-- fin de la vista -->
@endsection