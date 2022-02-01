<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medicamentos extends Model
{
    protected $table='gmedicamentos';

    protected $primaryKey="idgmedicamentos";

    public $timestamps=false;

    protected $fillable=[
    		
            
            'nombre',
            'marca',
            'cantidad',
            'concentracion',
            'tipomedicamento',
            'condicion'
    ];
}
