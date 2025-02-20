<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRamalToTbClientesContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_clientes_contatos', function (Blueprint $table) {
            //
            $table->string('ramal', 12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_clientes_contatos', function (Blueprint $table) {
            //
            $table->dropColumn('ramal');
        });
    }
}
