<!-- heredar la masterpage en esta vista -->
@extends('layouts.master')

<!-- Contenido vista-->
@section('contenido_vistas')

  <h2>Informacion del Empleado:</h2>
  <div class="card" style="width:400px">
    
    <div class="card-header">
    <h4 class="card-title">{{ $empleado->FirstName }} {{ $empleado->LastName}}</h4>
    </div>
    <div class="card-body">
        <h5 class="card-text">Cargo: {{ $empleado->Title }}</h5>
        <ul class="list-group list-gruoup-flush">
        @if($empleado->jefe_directo)
            <li class="list-group-item">Jefe Directo: 
                {{ $empleado->jefe_directo->FirsName}}
                {{ $empleado->jefe_directo->LastName }}
            </li>
        @endif
        <p>direccion:  {{ $empleado->Address }} , {{ $empleado->City}}, {{ $empleado->Country }}</p>
        <p>Fecha de nacimiento: {{ $empleado->BirthDate->toFormattedDateString() }}</p>
        <p>Fecha de Contratacion{{ $empleado->HireDate->toFormattedDateString() }}</p>
        </ul>
        <div>
            @if($empleado->jefes->count() !== 0)
                <h5 class="text-success">Subalternos: </h5>
                <ul>
                    @foreach($empleado->jefes as $subalterno)
                        <li class="list-group-item">{{ $subalterno->FirstName }} {{ $subalterno->LastName }} </li>
                    @endforeach
                </ul>
            @else
                <h5 class="text-danger">El empleado no tiene subalternos</h5>
            @endif
        </div>
   </div>
@endsection