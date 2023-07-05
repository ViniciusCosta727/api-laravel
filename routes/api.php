<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TarefasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get   ('/tarefas'      , [TarefasController::class, 'getAllTarefas']);
Route::get   ('/tarefas/{id}' , [TarefasController::class, 'getTarefa']);
Route::post  ('/tarefas'      , [TarefasController::class, 'createTarefa']);
Route::put   ('/tarefas/{id}' , [TarefasController::class, 'updateTarefa']);
Route::delete('/tarefas/{id}'  , [TarefasController::class, 'deleteTarefa']);