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

Route::get('/login', 'auth\LoginController@index')->name('login');
Route::post('/login', 'auth\LoginController@authenticate')->name('auth.index');

Route::get('/logout', 'auth\LoginController@logout')->name('logout');

Route::get('/register', 'auth\RegisterController@index')->name('register.index');
Route::post('/register', 'auth\RegisterController@register')->name('register.action');

Route::prefix('/tarefas')->group(function(){

    Route::get('/', 'TarefasController@list')->name('tarefas.list')->middleware('auth'); //Listagem de tarefas

    Route::get('add', 'TarefasController@add')->name('tarefas.add')->middleware('auth'); //Tela de adição de nova tarefa
    Route::post('add', 'TarefasController@addAction'); //Ação de adição de nova tarefa

    Route::get('edit/{id}', 'TarefasController@edit')->name('tarefas.edit')->middleware('auth'); //Tela de edição
    Route::post('edit/{id}', 'TarefasController@editAction'); //Ação de edição

    Route::get('delete/{id}', 'TarefasController@del')->name('tarefas.del')->middleware('auth'); //Ação de apagar

    Route::get('marcar/{id}', 'TarefasController@done')->name('tarefas.done'); // Marcar resolvido ou não

});
