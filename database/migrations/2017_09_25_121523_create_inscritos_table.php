<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscritos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curriculo_id')->unsigned();
            $table->integer('oferta_id')->unsigned();
            $table->boolean('seleccionado')->default(0);
            $table->timestamps();

            $table->foreign('curriculo_id')
            ->references('id')->on('curriculos')
            ->onDelete('restrict');

            $table->foreign('oferta_id')
            ->references('id')->on('ofertas')
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
        Schema::dropIfExists('inscritos');
    }
}
