<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artista;

class ArtistaController extends Controller
{
    //los controladores estan compuestos por:
    //por Acciones: metodos del Modelo
    //debe hacer una ruta para cada accion
    public function index()
    {
        //capturar datos de los modelos

        $artista= Artista::all();

        //echo "Entre al controlador";
        return view('artistas.index')
            ->with('artistas', $artista);
    }
    public function create()
    {
        //mostrar el formulario para registrar artista
        return view('artistas.new');
    }
    public function store(Request $r)
    {
        //echo "<pre>";
        //var_dump($r->input('nombre_artista'));
        //echo "</pre>";

        //crear modelo artista
        $nuevo_artista= new Artista();
        //asignamos atributos
        $nuevo_artista->Name= $r->input('nombre_artista');
        //grabar en la base de datos
        $nuevo_artista->save();
        echo "artista registrado";

    }
}
