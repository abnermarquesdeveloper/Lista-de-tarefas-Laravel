<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::view('/', 'welcome');

Route::view('/teste', 'teste');

Route::prefix('/tarefas')->group(function(){

    Route::get('/', 'TarefasController@list')->name('tarefas.list'); //Listagem de tarefas

    Route::get('add', 'TarefasController@add')->name('tarefas.add'); //Tela de adição de nova tarefa
    Route::post('add', 'TarefasController@addAction'); //Ação de adição de nova tarefa

    Route::get('edit/{id}', 'TarefasController@edit')->name('tarefas.edit'); //Tela de edição
    Route::post('edit/{id}', 'TarefasController@editAction'); //Ação de edição

    Route::get('delete/{id}', 'TarefasController@del')->name('tarefas.del'); //Ação de apagar

    Route::get('marcar/{id}', 'TarefasController@done')->name('tarefas.done'); // Marcar resolvido ou não

});
