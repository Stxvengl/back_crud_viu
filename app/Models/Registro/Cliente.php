<?php

namespace App\Models\Registro;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'cedula',
        'nombres',
        'apellidos',
        'celular',
        'direccion',
        'email',
        'estado',
        'ip',
        'terminal',
        'id_usuario_auditor',
        'fecha_creacion',

    ];
    public $timestamps = false;

}
