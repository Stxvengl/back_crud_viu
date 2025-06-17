<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $table = 'articulos';
    protected $primaryKey = 'id_articulo';
    public $timestamps = false;
    protected $fillable = [
        'id_articulo',
        'codigo',
        'descripcion',
        'id_localidad',
        'estado',
        'fecha_creacion',
        'id_usuario_auditor',
        'ip',
        'terminal'
    ];
    //
}
