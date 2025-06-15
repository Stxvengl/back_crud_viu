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
    public function Registro(Request $request)
    {
        try {
            log::alert("Registro => " . collect($request->values));
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

    public function ObtenerClientes(Request $request)
    {
        try {
            log::alert("ObtenerClientes => " . collect($request->all()));
            $clientes = $this->RegistroServices->GetInfoclientes($request->all());
            if (!$clientes->ok) {
                throw new Exception($clientes->message, (int)$clientes->code);
            }
            return response()->json([
                'ok' => true,
                'data' => $clientes->data,
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
    public function ActualizaClientes(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'cedula' => 'required|string|max:10',
            ]);
            $updateCliente = $this->RegistroServices->UpdateClientes($request->all());
            if (!$updateCliente->ok) {
                throw new Exception($updateCliente->message, (int)$updateCliente->code);
            }
            DB::commit();
            return response()->json([
                'ok' => true,
                'text' => [
                    'message' => 'Se actualizó correctamente el registro.'
                ]
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            log::alert("ERROR => " . __FILE__ . " =>" . __FUNCTION__ . " =>" . $e);
            return response()->json([
                'ok' => false,
                'text' => [
                    'message' => $e->GetMessage()
                ]
            ], 400);
        }
    }
        public function DeleteClientes(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'cedula' => 'required|string|max:10',
            ]);
            $deleteCliente = $this->RegistroServices->DeleteClientes($request->all());
            if (!$deleteCliente->ok) {
                throw new Exception($deleteCliente->message, (int)$deleteCliente->code);
            }
            DB::commit();
            return response()->json([
                'ok' => true,
                'text' => [
                    'message' => 'Se Elimino correctamente el registro.'
                ]
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
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
