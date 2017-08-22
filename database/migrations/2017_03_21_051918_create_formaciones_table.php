<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curriculo_id')->unsigned();
            $table->string('centro_educativo');
            $table->integer('profesione_id')->unsigned();
            $table->integer('nivele_id')->unsigned();
            $table->date('inicio');
            $table->date('fin')->nullable();
            $table->boolean('continua')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('curriculo_id')
                  ->references('id')->on('curriculos')
                  ->onDelete('restrict')
                  ->onUpdate('no action');
            
            $table->foreign('profesione_id')
                  ->references('id')->on('profesiones')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('nivele_id')
                  ->references('id')->on('niveles')
                  ->onDelete('restrict')
                  ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formaciones');
    }
}
