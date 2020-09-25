<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo "Hola";
        //recuperar los empleados
        $empleados= \App\Empleado::paginate(3);
        //mostrar una vista con los empleados
        return view('empleados.index')->with("empleados", $empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Selecciones los empleados cuyos id sea 1 2 y 6
        $managers= \App\Empleado::find([1,2,6]);
        
        //Cargos 
        $cargos= \App\Empleado::select("Title")->distinct()->where('Title','!=','General Manager')->get();

        //echo "Hola a la pagina de create";
        //Mostrar la vista de registrar empleado
        return view("empleados.insert")
                    ->with("jefes", $managers)
                    ->with("cargos", $cargos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //crear un objeto de tipo empleado
        //var_dump($_POST);
        $empleadoN= new \App\Empleado();
        //asignar valores a los atributos
        $empleadoN->FirstName=  $request->input("nombre");
        $empleadoN->LastName=  $request->input("apellido");
        $empleadoN->ReportsTO= $request->input("selectjefe");
        $empleadoN->Title=     $request->input("selectcargo");
        $empleadoN->BirthDate= $request->input("fechan");
        $empleadoN->HireDate=  $request->input("fechac");
        $empleadoN->Address=   $request->input("direccion");
        $empleadoN->City=      $request->input("ciudad");
        $empleadoN->Email=     $request->input("email");
        //registrar el objeto a la base de datos
        $empleadoN->save();
        //echo "registrado";
        return redirect("empleados")->with("mensaje", "Empleado registrado");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //mostrar detalle del empleado cuyo $id es el del parametro 
        //echo $id;
        //$empleado= $empleado = \App\Empleado::with('subalternos')->find($id);//= a un select * from de la tabla con el id seleccionado
        $empleado= \App\Empleado::find($id);//= a un select * from de la tabla con el id seleccionado
        /*echo "<pre>";
        var_dump($empleado);
        echo "</pre>";
        */
        $empleado= \App\Empleado::with('jefes')->with('clientes')->with('jefe_directo')->find($id);



        return view('empleados.show')->with("empleado", $empleado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //editar 
        //seleccionar el empleado a editar
        //echo $id;
        $empleado= \App\Empleado::find($id);

        $managers= \App\Empleado::find([1,2,6]);

        $cargos= \App\Empleado::select("Title")->distinct()->where('Title','!=','General Manager')->get();

        //Llevar el empleado a editar a la vista
        return view("empleados.edit")->with("empleado", $empleado)
                                     ->with("jefes", $managers)
                                     ->with("cargos", $cargos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Editar
        //var_dump($request->all());
        //echo "<hr />";
        //var_dump($id);
        $regla=[
            "jefe" => "required"
        ];

        //crear objeto de validador
        $validador= Validator::make($request->all(), $regla);
        
        //validador
        if($validador->fails()){
            return redirect("empleados/$id/edit")->withErrors($validador);
        }

        //seleccionar el id que se va a actualizar
        $empleado = \App\Empleado::find($id);
        //asignar valores a los atributos
        $empleado->FirstName=  $request->input("nombre");
        $empleado->LastName=  $request->input("apellido");
        $empleado->ReportsTO= $request->input("selectjefe");
        $empleado->Title=     $request->input("selectcargo");
        $empleado->BirthDate= $request->input("fechan");
        $empleado->HireDate=  $request->input("fechac");
        $empleado->Address=   $request->input("direccion");
        $empleado->City=      $request->input("ciudad");
        $empleado->Email=     $request->input("email");
        //guardar
        $empleado->save();
        return redirect("empleados/$empleado->EmployeeId/edit")->with("mensaje", "Empleado Actualizado");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
