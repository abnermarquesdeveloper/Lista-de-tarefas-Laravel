<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    //protected $table = 'nome_da_tabela'; //sem essa variável o ORM assume que o nome da tabela no banco é o nome desse Model no plural "tarefas".
    //protected $primaryKey = "tarefa_id"; //sem essa o ORM assume que a chave primária da tabela seja "id"
    //public $incrementing = false; //sem essa o padrão é "true"
    //protected $keyType = 'string'; //sem essa o padrão da chave primária é o "Inteiro"

    public $timestamps = false; //por padrão é "true" e considera que no banco tem tuplas "create_at" e "update_at" que é para o registro da data da criação
    protected $fillable = ['titulo']; // propriedade para que possa fazer update no campo "titulo" com uma linha só com "Eloquent ORM". "Ver TarefasController" "function editAction()"
}
