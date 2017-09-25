<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->integer('empresa_id')->unsigned();
            $table->integer('profesione_id')->unsigned();
            $table->string('salario');
            $table->integer('municipio_id')->unsigned();
            $table->integer('vacantes')->default(0);
            $table->timestamps();

            $table->foreign('empresa_id')
            ->references('id')->on('empresas')
            ->onDelete('restrict');

            $table->foreign('profesione_id')
            ->references('id')->on('profesiones')
            ->onDelete('restrict')
            ->onUpdate('no action');

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
        Schema::dropIfExists('ofertas');
    }
}
