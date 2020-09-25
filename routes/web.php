<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return view("welcome");
});
//ruta de pruebas
Route::get("Hola", function(){
    echo "Funciona bien";
});

//ruta Arreglos
Route::get("Arreglo", function(){
    //defino un arreglo
    $estudiantes= ["D" => "Daniel", "E" => "Eduardo", "K" => "Karen", "J" => "Johari"];
    //var_dump($estudiantes);
    //recorrer el ciclo foreach
    foreach($estudiantes as $indice => $e){
        echo "$e tiene el indice: $indice </br>";
    }
});
    //ruta de un arreglo con varias dimensiones
    Route::get("paises", function(){
        $paises= [
        "Colombia" => [
            "Capital" =>"Bogota",
            "Moneda" =>"Peso Colombiando",
            "Poblacion" => 50372424.0,
            "Ciudades" => ["Medellin", "Cali", "Barranquilla"]
        ], 
        "Venezuela" => [
            "Capital" =>"Caracas",
            "Moneda" =>"Bolivar",
            "Poblacion" => 32606000.0,
            "Ciudades" => ["Maracaibo", "Maracay", "C.Bolivar"]
        ], 
        "Peru" => [
            "Capital" =>"Lima",
            "Moneda" =>"Sol",
            "Poblacion" => 33050325.0,
            "Ciudades" => ["Cuzco", "Trujillo", "Arequipa"]
        ], 
        "Ecuador" => [
            "Capital" =>"Quito",
            "Moneda" =>"Dolar",
            "Poblacion" =>290372,
            "Ciudades" => ["Guayaquil", "Cuenca", "Machala"]
            ]
    ];
        //Enviar datos de paises a una vista
        // con la funcion view
        return view("paises")->with("paises", $paises);
});

//rutas de controlador
route::get('artistas', "ArtistaController@index");
route::get('artistas/create', "ArtistaController@create");
route::post('artistas/store', "ArtistaController@store");

route::resource('empleados', 'EmpleadoController');
route::get('master', function(){
    return view('layouts.master');
});