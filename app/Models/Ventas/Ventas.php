<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    public $timestamps = false;
    protected $fillable = [
        'estado',
        'id_localidad',
        'id_usuario_auditor',
        'ip',
        'terminal'
    ];
    // Aquí puedes agregar relaciones, scopes, etc.
}
