<?php

namespace App\Service\Registro;

use App\Models\Registro\Cliente;
use App\Service\Response;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Isset_;

class RegistroService
{

    public function store($input)
    {
        try {
            $input = (object) $input;
            $response = new Response();
            $consulta = Cliente::where('estado', 'A')
                ->where('cedula', $input->cedula)
                ->first();
            if ($consulta) {
                $response->Setok(false);
                $response->SetMessage('ERROR: Ya existe un registro con la cédula ingresada.');
                $response->SetData($consulta);
                $response->SetCode(202);
                return $response;
            } else {
                $store = new Cliente();
                $store->cedula = $input->cedula;
                $store->nombres = strtoupper($input->nombres);
                $store->apellidos = strtoupper($input->apellidos);
                $store->celular = $input->celular;
                $store->direccion = $input->direccion;
                $store->correo = $input->email;
                $store->estado = 'A';
                $store->ip = 'localhost';
                $store->terminal = 'localhost';
                $store->id_usuario_auditor = 1;
                $store->fecha_creacion = now();
                if ($store->save()) {
                    $response->Setok(true);
                    $response->SetMessage('Registro guardado correctamente.');
                    $response->SetData($store);
                    $response->SetCode(200);
                } else {
                    $response->Setok(false);
                    $response->SetMessage('ERROR: No se pudo guardar el registro.');
                    $response->SetData(null);
                    $response->SetCode(202);
                }
            }
        } catch (Exception $e) {
            $response->Setok(false);
            $response->SetMessage($e->GetMessage());
            $response->SetCode($e->GetCode());
        }
        return $response;
    }
    public function GetInfoclientes($input)
    {
        $response = new Response();
        try {
            $input = (object)$input;
            $consulta = Cliente::where('estado', 'A');
            if (isset($input->cedula) && !empty($input->cedula)) {
                $consulta = $consulta->where('cedula', $input->cedula);
            }
            if (isset($input->nombre) && !empty($input->nombre)) {
                $nombre = strtolower($input->nombre);
                $consulta = $consulta->whereRaw("LOWER(nombres) LIKE ?", ["%{$nombre}%"]);
            }
            $consulta = $consulta->get();
            if (!$consulta || $consulta->isEmpty()) {
                $response->SetOk(false);
                $response->SetMessage('ERROR: No se encontraron registros de clientes.');
                $response->SetCode(202);
            } else {
                $response->SetData($consulta);
            }
        } catch (Exception $e) {
            $response->SetOk(false);
            $response->SetMessage($e->GetMessage());
            $response->SetCode($e->GetCode());
        }
        return $response;
    }
    public function UpdateClientes($input)
    {
        $response = new Response();
        try {
            $input = (object)$input;
            $update = Cliente::where('estado', 'A')
                ->where('cedula', $input->cedula)
                ->first();
            if (!$update) {
                $response->SetOk(false);
                $response->SetMessage('Cedula Incorrecta por favor verifique el dato a Editar.');
                $response->SetCode(202);
            } else {
                $update->nombres =   isset($input->nombres) ? strtoupper($input->nombres) : $update->nombres;
                $update->apellidos = isset($input->apellidos) ? strtoupper($input->apellidos) : $update->apellidos;
                $update->celular = isset($input->celular) ? $input->celular : $update->celular;
                $update->direccion = isset($input->direccion) ? $input->direccion : $update->direccion;
                $update->correo = isset($input->email) ? $input->email : $update->correo;
                $update->fecha_actualizacion = now();
                if ($update->save()) {
                    $response->SetOk(true);
                    $response->SetMessage('Registro actualizado correctamente.');
                    $response->SetData($update);
                    $response->SetCode(200);
                } else {
                    $response->SetOk(false);
                    $response->SetMessage('No se pudo actualizar el registro.');
                    $response->SetData(null);
                    $response->SetCode(202);
                }
            }
        } catch (Exception $e) {
            Log::error("ERROR " . __FILE__ . ":" . __FUNCTION__ . "-> " .__LINE__. "-> " . $e);
            $response->SetOk(false);
            $response->SetMessage($e->GetMessage());
            $response->SetCode($e->GetCode());
        }
        return $response;
    }
     public function DeleteClientes($input)
    {
        $response = new Response();
        try {
            $input = (object)$input;
            $update = Cliente::where('estado', 'A')
                ->where('cedula', $input->cedula)
                ->first();
            if (!$update) {
                $response->SetOk(false);
                $response->SetMessage('Cedula Incorrecta por favor verifique el dato a Editar.');
                $response->SetCode(202);
            } else {
                $update->estado = 'I';
                $update->fecha_actualizacion = now();
                if ($update->save()) {
                    $response->SetOk(true);
                    $response->SetMessage('Registro Elimino correctamente.');
                    $response->SetData($update);
                    $response->SetCode(200);
                } else {
                    $response->SetOk(false);
                    $response->SetMessage('No se pudo eliminar el registro.');
                    $response->SetData(null);
                    $response->SetCode(202);
                }
            }
        } catch (Exception $e) {
            Log::error("ERROR " . __FILE__ . ":" . __FUNCTION__ . "-> " .__LINE__. "-> " . $e);
            $response->SetOk(false);
            $response->SetMessage($e->GetMessage());
            $response->SetCode($e->GetCode());
        }
        return $response;
    }
}
