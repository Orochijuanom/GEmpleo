<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('identificacione_id')->unsigned();
            $table->string('numero_identificacion');
            $table->date('fecha_nacimiento');
            $table->integer('estado_id')->unsigned();
            $table->string('telefono');
            $table->integer('municipio_id')->unsigned();
            $table->string('direccion');
            $table->integer('paise_id')->unsigned();
            $table->boolean('discapacidad')->default(0)->nullable();
            $table->string('foto');
            $table->string('video')->nullable();
            $table->integer('profesione_id')->unsigned();
            $table->text('descripcion');
            $table->integer('situacione_id')->unsigned();
            $table->integer('salario');
            $table->boolean('disponibilidad_viajar');
            $table->boolean('disponibilidad_cambio_residencia');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('identificacione_id')
                  ->references('id')->on('identificaciones')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('estado_id')
                  ->references('id')->on('estados')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('municipio_id')
                  ->references('id')->on('municipios')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('paise_id')
                  ->references('id')->on('paises')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('profesione_id')
                  ->references('id')->on('profesiones')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('situacione_id')
                  ->references('id')->on('situaciones')
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
        Schema::dropIfExists('curriculos');
    }
}
