<?php

namespace App\Http\Controllers;

use App\Models\Tarefas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class TarefasController extends Controller
{
    
	// busca todas as tarefas
	
	public function getAllTarefas() {
    
    $tarefas = Tarefas::get()->toJson(JSON_PRETTY_PRINT);
    return response($tarefas, 200);
	  
  }    

    // cria tarefa
	
	public function createTarefa(Request $request) {

      $tarefa = new Tarefas;
      $tarefa->titulo    = $request->titulo;
      $tarefa->descricao = $request->descricao;
      $tarefa->status    = $request->status;
      $tarefa->save();

      return response()->json([
          "message" => "Tarefa criada"
      ], 201);

    }

  // busca uma tarefa
	
	public function getTarefa($id) {
      
	  if (Tarefas::where('id', $id)->exists()) {
        
		$tarefa = Tarefas::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        
		return response($tarefa, 200);
		
      } else {
        
		return response()->json([
          "message" => "Tarefa inexistente"
        ], 404);
		
      }
	  
    }

  // atualiza uma tarefa
	
	public function updateTarefa(Request $request, $id) {
      
	  if (Tarefas::where('id', $id)->exists()) {
        
		$tarefa = Tarefas::find($id);
        $tarefa->titulo    = is_null($request->titulo)    ? $tarefa->titulo    : $request->titulo;
        $tarefa->descricao = is_null($request->descricao) ? $tarefa->descricao : $request->descricao;
        $tarefa->status    = is_null($request->status)    ? $tarefa->status    : $request->status;
        $tarefa->save();

        return response()->json([
            "message" => "Tarefa atualizada"
        ], 200);
      
  	  } else {

        return response()->json([
            "message" => "Tarefa inexistente"
        ], 404);
		
    }
  }

  // apaga uma tarefa
	
	public function deleteTarefa ($id) {
      
	  if(Tarefas::where('id', $id)->exists()) {
        
		$tarefa = Tarefas::find($id);
        $tarefa->delete();

        return response()->json([
          "message" => "Tarefa apagada"
        ], 202);
        
      } else {
        
		return response()->json([
          "message" => "Tarefa inexistente"
        ], 404);
		
    }
	
  }
}