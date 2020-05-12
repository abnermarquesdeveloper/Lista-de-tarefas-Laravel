<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tarefa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TarefasController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function list(){
        //Pega o usuário que está logado. Pode também usar o "request" request->user();
        $user = Auth::user();

        //$list = DB::select('SELECT * FROM tarefas'); // instruções SQL com "Query Builder"
        $list = Tarefa::all(); // instruções com ORM "Enloquent"
        
        return view('tarefas.list', [
            'list' => $list,
            'name' => $user->name,
            'permissao' => Gate::allows('add-user')

        ]);
    }

    public function add(){
        //Só permite usuários admin adicionar outros usuários...
        if(Gate::allows('add-user')){
            return view('tarefas.add');
        }else{
            return redirect()->route('tarefas.list');
        }
    }

    public function addAction(Request $request){
        $request->validate([
            'titulo' => ['required', 'string']
        ]);
        
        $titulo = $request->input('titulo');
        //instruções SQL com "Query Builder"
        /*DB::insert('INSERT INTO tarefas (titulo) VALUES (:titulo)', [
            'titulo' => $titulo
        ]);*/ 

        //instruções com ORM "Enloquent"
        $tarefa = new Tarefa;
        $tarefa->titulo = $titulo;
        $tarefa->save();

        return redirect()->route('tarefas.list');
    }

    public function edit($id){
        // "QueryBuilder"
        /*$data = DB::select('SELECT * FROM tarefas WHERE id = :id', [
            'id' => $id
        ]);*/

        // "ORM Eloquent"
        $data = Tarefa::find($id);

        //if(count($data) > 0){ //com "QueryBuilder"
            if($data){ //Com Eloquent
            return view('tarefas.edit', [
                //'data' => $data[0] //com "QueryBuilder"
                'data' => $data //com "Eloquent"
            ]);
        }else{
            return redirect()->route('tarefas.list');
        }   
    }

    public function editAction(Request $request, $id){
        $request->validate([
            'titulo'=> ['required', 'string']
        ]);

        $titulo = $request->input('titulo');
        /*$data = DB::select('SELECT * FROM tarefas WHERE id = :id', [
            'id' => $id
        ]);*/ //com "QueryBuilder"
        /*if(count($data) > 0){
            DB::update('UPDATE tarefas SET titulo = :titulo WHERE id = :id', [
                'id' => $id,
                'titulo' => $titulo
            ]);
        }*/
        //Com "Eloquent"
        /*$data = Tarefa::find($id);
        $data->titulo = $titulo;
        $data->save();*/ //OU...

        // update com uma única linha. mas para isso de colocar a propriedade no Model "Tarefa" // Protected $fillable = ['titulo'];
        Tarefa::find($id)->update(['titulo'=>$titulo]);

        return redirect()->route('tarefas.list'); 
    }

    public function del($id){
        /*DB::delete('DELETE FROM tarefas WHERE id = :id', [
            'id' => $id
        ]);*/  //com "QueryBuilder"

        //com "Eloquent ORM"
        Tarefa::find($id)->delete();

        return redirect()->route('tarefas.list');
    }

    public function done($id){
        /*DB::update('UPDATE tarefas SET resolvido = 1 - resolvido WHERE id = :id', [
            'id' => $id
        ]);*/

        //com "Eloquent ORM"
        $tarefa = Tarefa::find($id);
        if($tarefa){
            $tarefa->resolvido = 1 - $tarefa->resolvido;
            $tarefa->save();    
        }
        return redirect()->route('tarefas.list');
    }
}
