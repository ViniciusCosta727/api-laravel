<h1>API em <a href="https://laravel.com/"><img src="https://laravel.com/img/logotype.min.svg"></a> - Conclusão da matéria Criação de API Rest básica com PHP </h1>

- No arquivo **.env**, é definido o caminho do banco de dados via **MySQL**

````php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=api_tarefas
DB_USERNAME=root
DB_PASSWORD=
````

- É definido os termos pela classe migração na database e no arquivo **Tarefas.php**

````php
public function up(): void
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('descricao');
            $table->string('status');
            $table->timestamps();
    });		
		
		
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
````
````php
class Tarefas extends Model
{
    protected $fillable = [
          'titulo', 
          'descricao', 
          'status'];
````


- No arquivo **Api.php**, podem ser configuradas as rotas para o arquivo **TarefasController.php**

````php
Route::get   ('/tarefas'      , [TarefasController::class, 'getAllTarefas']);
Route::get   ('/tarefas/{id}' , [TarefasController::class, 'getTarefa']);
Route::post  ('/tarefas'      , [TarefasController::class, 'createTarefa']);
Route::put   ('/tarefas/{id}' , [TarefasController::class, 'updateTarefa']);
Route::delete('/tarefas/{id}' , [TarefasController::class, 'deleteTarefa']);
````


- No arquivo **TarefasController.php**, são implementadas as rotinas do **CRUD**

````php
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
````
<h2>Link para o vídeo de apresentação</h2>
<a href="https://youtu.be/RgloakrZutM"><img src="https://cdn.discordapp.com/attachments/668195190829219887/1125960945223602256/youtube-logo.png" width=550 height=350></a>
