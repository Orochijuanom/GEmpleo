<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLenguajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lenguajes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curriculo_id')->unsigned();
            $table->integer('idioma_id')->unsigned();
            $table->integer('inivele_id')->unsigned();
            $table->timestamps();

            $table->foreign('curriculo_id')
                  ->references('id')->on('curriculos')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('idioma_id')
                  ->references('id')->on('idiomas')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('inivele_id')
                  ->references('id')->on('iniveles')
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
        Schema::dropIfExists('lenguajes');
    }
}
