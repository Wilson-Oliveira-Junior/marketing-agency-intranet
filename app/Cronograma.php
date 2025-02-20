<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    protected $table = "tb_cronogramas";
    public $timestamps = false;

    protected $fillable = [
        'id_tarefa', 'data',
    ];
}
