<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompraLoteGanadoTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_lote_ganado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('peso', 100);
            $table->string('observaciones', 200)->nullable();
            $table->integer('fincas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->integer('compra_lote_id')->unsigned();
            $table->foreign('fincas_id')->references('id')->on('fincas');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('compra_lote_id')->references('id')->on('compra_lote');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('compra_lote_ganado');
    }
}
