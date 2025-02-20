<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Status extends Model{

    use Notifiable;

    protected $table = "tb_status";

    protected $fillable = ['nome', 'descricao', 'status'];

}
