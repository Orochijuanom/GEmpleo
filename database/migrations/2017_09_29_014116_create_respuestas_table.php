<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('opcione_id')->unsigned();
            $table->integer('inscrito_id')->unsigned();
            $table->timestamps();

            $table->foreign('opcione_id')
            ->references('id')->on('opciones')
            ->onDelete('restrict');

            $table->foreign('inscrito_id')
            ->references('id')->on('inscritos')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
}
