<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table= "employees";
    protected $primaryKey= "EmployeeId";
    public $timestamps = false;

    //tratamiento de fechas
    protected $dates=[
        'BirthDate', 'HireDate'
    ];
    //relacion jefe - sus empleados
    public function jefes(){
        return $this->hasMany('App\Empleado', 'ReportsTo');
    }
    //relacion empleados jefes
    public function jefe_directo(){
        return $this->beLongsTo('App\Empleado', 'ReportsTo');
    }
    //relacion clientes y empleados
    public function clientes(){
        return $this->hasMany('App\Customer' , 'SupportRepId');
    }
}
