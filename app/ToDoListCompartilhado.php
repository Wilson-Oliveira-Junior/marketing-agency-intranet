<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoListCompartilhado extends Model
{
    protected $table = "tbToDoList_Compartilhados";
    protected $fillable = ['id_todolist', 'id_usuario'];
}
