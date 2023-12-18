<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{

    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Paciente::all());
    }


    public function show($id)
    {
        try {
            return response()->json(Paciente::findOrFail($id));

        }catch (\Exception $error) {
            $responseError = [
                'Erro' => "O paciente com id: $id não foi encontrado!",
                'Exception' => $error->getMessage(),
            ];
            $statusHttp = 404;
            return response()->json($responseError, $statusHttp);
        }
    }

    public function store(Request $request) {
        try {
            $newPaciente = $request->all();
            $storedPaciente = Paciente::create($newPaciente);
            return response()->json([
                'msg'=>'Paciente inserido com sucesso!',
                'paciente'=>$storedPaciente
            ]);
        }catch (\Exception $error) {
            $responseError = [
                'Erro'=> "Erro ao inserir novo paciente!",
                'Exception'=>$error->getMessage()
            ];
            $statusHttp = 404;
            return response()->json($responseError, $statusHttp);
        }
    }

    public function update (Request $request, $id) {
        try {
            $data = $request->all();
            $newPaciente = Paciente::findOrFail($id);
            $newPaciente->update($data);
            return response()->json([
                "msg"=>"Paciente atualizado com sucesso!",
                "paciente"=>$newPaciente
            ]);
        }catch (\Exception $error) {
            return response()->json([
                'Erro'=>"Erro ao atualizar o paciente!",
                'Exception'=>$error->getMessage()
            ], 404);
        }
    }

    public function remove($id) {
        try {
            if(Paciente::findOrFail($id)->delete())
                return response()->json(["msg"=>"Paciente com id: $id removido com sucesso!"]);
        }catch (\Exception $error) {
            return response()->json([
                'Erro'=>"Erro ao excluir o paciente!",
                'Exception'=>$error->getMessage()
            ], 404);
        }
    }

}