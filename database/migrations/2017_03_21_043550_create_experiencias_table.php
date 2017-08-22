<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curriculo_id')->unsigned();
            $table->string('empresa');
            $table->integer('departamento_id')->unsigned();
            $table->integer('sectore_id')->unsigned();
            $table->string('cargo');
            $table->integer('area_id')->unsigned();
            $table->date('inicio');
            $table->date('fin')->nullable();
            $table->boolean('continua')->nullable()->default(0);
            $table->text('descripcion');
            $table->timestamps();

            $table->foreign('curriculo_id')
                  ->references('id')->on('curriculos')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('departamento_id')
                  ->references('id')->on('departamentos')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('sectore_id')
                  ->references('id')->on('sectores')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('area_id')
                  ->references('id')->on('areas')
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
        Schema::dropIfExists('experiencias');
    }
}
