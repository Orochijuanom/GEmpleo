<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('logo');
            $table->string('nombre');
            $table->string('nit');
            $table->integer('sectore_id')->unsigned();
            $table->string('telefono');
            $table->integer('municipio_id')->unsigned();
            $table->string('direccion');
            $table->text('descripcion');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict');

            $table->foreign('sectore_id')
                  ->references('id')->on('sectores')
                  ->onDelete('restrict');
                  
            $table->foreign('municipio_id')
                  ->references('id')->on('municipios')
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
        Schema::dropIfExists('empresas');
    }
}
