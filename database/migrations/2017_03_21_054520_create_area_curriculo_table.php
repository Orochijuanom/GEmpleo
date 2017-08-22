<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaCurriculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_curriculo', function (Blueprint $table) {
            $table->integer('area_id')->unsigned();
            $table->integer('curriculo_id')->unsigned();
            $table->timestamps();

            $table->foreign('area_id')
                  ->references('id')->on('areas')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('curriculo_id')
                  ->references('id')->on('curriculos')
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
        Schema::dropIfExists('area_curriculo');
    }
}
