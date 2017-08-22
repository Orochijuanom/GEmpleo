<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculoLicenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculo_licencia', function (Blueprint $table) {
            $table->integer('curriculo_id')->unsigned();
            $table->integer('licencia_id')->unsigned();
            $table->timestamps();

            $table->foreign('curriculo_id')
                  ->references('id')->on('curriculos')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('licencia_id')
                  ->references('id')->on('licencias')
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
        Schema::dropIfExists('curriculo_licencia');
    }
}
