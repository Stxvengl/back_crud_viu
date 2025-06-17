<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Service\Registro\RegistroService;

class ClientesController extends Controller
{
    protected $RegistroServices;

    public function __construct()
    {
        $this->RegistroServices = new RegistroService();
    }
    public function saveVentas(Request $request)
    {
        try {
            DB::beginTransaction();
             $ResponseStore = $this->RegistroServices->store($request->values);
            if (!$ResponseStore->ok) {
                throw new Exception($ResponseStore->message, (int)$ResponseStore->code);
            }
            DB::commit();
            return response()->json([
                'ok' => true,
                'text' => [
                    'message' => 'Se guardó correctamente el registro.'
                ],
                "data" => $ResponseStore->data
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("ERROR " . __FILE__ . ":" . __FUNCTION__ . "-> " . $e);
            return response()->json([
                'ok' => false,
                'text' => [
                    'message' => $e->GetMessage()
                ]
            ], 400);
        }
    }

    public function obtenerInformacionArticulo(Request $request)
    {
        try {
            $articulo = $this->RegistroServices->obtenerInformacionArticulo($request->values);
            log::alert("ARTICULO => " . collect($articulo));
            if (!$articulo->ok) {
                throw new Exception($articulo->message, (int)$articulo->code);
            }
            return response()->json([
                'ok' => true,
                'data' => $articulo->data,
            ], 200);
        } catch (Exception $e) {
            log::alert("ERROR => " . __FILE__ . " =>" . __FUNCTION__ . " =>" . $e);
            return response()->json([
                'ok' => false,
                'text' => [
                    'message' => $e->GetMessage()
                ]
            ], 400);
        }
    }
      public function obtenerventas(Request $request)
    {
        try {
            $articulo = $this->RegistroServices->obtenerventas($request->values);
            if (!$articulo->ok) {
                throw new Exception($articulo->message, (int)$articulo->code);
            }
            return response()->json([
                'ok' => true,
                'data' => $articulo->data,
            ], 200);
        } catch (Exception $e) {
            log::alert("ERROR => " . __FILE__ . " =>" . __FUNCTION__ . " =>" . $e);
            return response()->json([
                'ok' => false,
                'text' => [
                    'message' => $e->GetMessage()
                ]
            ], 400);
        }
    }
    
  
}
