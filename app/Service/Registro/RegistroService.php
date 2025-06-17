<?php

namespace App\Service\Registro;

use App\Models\Registro\Cliente;
use App\Models\Ventas\Articulos;
use App\Models\Ventas\Ventas;
use App\Service\Response;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Isset_;

class RegistroService
{

    public function obtenerInformacionArticulo($input)
    {
        try {
            $input = (object) $input;
            $response = new Response();
            $consulta = Articulos::where('estado', 'A')
                ->where('id_localidad', 1)
                ->select(
                    'id_articulo as value',
                    'descripcion as label',
                )
                ->get();
                $response->SetData($consulta);
        } catch (Exception $e) {
            $response->Setok(false);
            $response->SetMessage($e->GetMessage());
            $response->SetCode($e->GetCode());
        }
        return $response;
    }

    public function obtenerventas($input)
    {
        try {
            $input = (object) $input;
            $response = new Response();
            $consulta = Ventas::where('ventas.estado', 'A')
                ->join('articulos', 'articulos.id_articulo', '=', 'ventas.id_articulo')
                ->where('articulos.estado', 'A')
                ->join('localidad', 'articulos.id_localidad', '=', 'localidad.id_localidad')
                ->where('localidad.estado', 'A')
                ->join('users', 'users.id_localidad', '=', 'localidad.id_localidad')
                ->where('users.id', 1)
                //->where('users.id', $input->id_usuario)
                ->select(
                    'users.name as nombre',
                    'articulos.descripcion as desc_articulo',
                    'articulos.codigo as codigo_articulo',
                    'localidad.descripcion as descripcion_localidad',
                    'ventas.valor_venta',
                );
                if (isset($input->nombre) && !empty($input->nombre)) {
                $nombre = strtolower($input->nombre);
                $consulta = $consulta->whereRaw("LOWER(users.name) LIKE ?", ["%{$nombre}%"]);
            }
            $paginate = $consulta->paginate($input->itemsPerPage, ['*'], 'page', $input->page);
            
            $response->SetData($paginate);
        } catch (Exception $e) {
            $response->Setok(false);
            $response->SetMessage($e->GetMessage());
            $response->SetCode($e->GetCode());
        }
        return $response;
    }
      public function store($input)
    {
        $response = new Response();
        try {
            log::alert(collect($input));
            $input = (object) $input;
            $store = new Ventas();
            $store->id_articulo = $input->articulo_id;
            $store->valor_venta = $input->valor_venta;
            $store->id_usuario_auditor = isset($input->id_usuario) ? $input->id_usuario : 1;
            $store->estado = 'A';
            $store->ip = isset($input->ip) ? $input->ip : '109.168.10.102';
            $store->terminal = isset($input->terminal) ? $input->terminal : 'localhost';

            $store->fecha_creacion = now();
            $store->save();
            $response->SetData($store);
        } catch (Exception $e) {
            $response->Setok(false);
            $response->SetMessage($e->GetMessage());
            $response->SetCode($e->GetCode());
        }
        return $response;
    }
   
}
