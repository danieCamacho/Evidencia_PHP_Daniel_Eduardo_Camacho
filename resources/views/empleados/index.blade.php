<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        @if(session("mensaje"))
            <p class="alert-success">{{ session("mensaje") }}</p>
        @endif
        <h1>lista de empleados</h1>
        <a class="btn btn-dark mb-3" href="{{ url('empleados/create') }}">
            Nuevo Empleado
        </a>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Nombre Completo</th>
                <th scope="col">Cargo</th>
                <th scope="col">Email</th>
                <th scope="col">Detalle</th>
                <th scope="col">Actualizar</th>

                <!--
                <th scope="col">Fecha N</th>
                <th scope="col">Fecha C</th>
                <th scope="col">Direccion</th>
                <th scope="col">Ciudad</th>
                -->
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->FirstName }} {{ $empleado->LastName }}</td>
                        <td>{{ $empleado->Title }}</td>
                        <td>{{ $empleado->Email }}</td>
                        <td>
                            <!--<a href='{{ url("empleados/$empleado->EmployeeId") }}' class="btn btn-success">Ver Detalles</a>-->
                            <a href="{{ url('empleados/'.$empleado->EmployeeId) }}" class="btn btn-success">Ver Detalles</a>
                        </td>
                        <th>
                            <a href="{{ url('empleados/'.$empleado->EmployeeId.'/edit') }}" class="btn btn-info">Actualizar</a>
                        </th>

                        <!--
                        <td>
                            @if($empleado->jefe_directo()->get()->isNotEmpty())
                                {{ $empleado->jefe_directo()->get()->first()->LastName }}
                                {{ $empleado->jefe_directo()->get()->first()->FirstName }}
                            @else
                                {{ "Empleado sin Jefe directo" }}
                            @endif
                        </td>
                        <td>{{ $empleado->BirthDate->isoFormat("MMM Do YY") }}</td>
                        <td>{{ $empleado->HireDate->isoFormat("MMM Do YY") }}</td>
                        <td>{{ $empleado->Address }}</td>
                        <td>{{ $empleado->City }}</td>
                        -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $empleados->links() }}
    </div>
</body>
</html>