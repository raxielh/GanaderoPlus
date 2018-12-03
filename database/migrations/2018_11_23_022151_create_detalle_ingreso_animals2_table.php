<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetalleIngresoAnimals2Table extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ingreso_animals2', function (Blueprint $table) {
            $table->increments('id');
            $table->string('observaciones', 200)->nullable();
            $table->integer('peso')->unsigned();
            $table->integer('detalle_ingreso_animals_id')->unsigned();
            $table->integer('registro_compra_lote_id')->unsigned();
            $table->integer('fincas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('detalle_ingreso_animals_id')->references('id')->on('detalle_ingreso_animals');
            $table->foreign('registro_compra_lote_id')->references('id')->on('detalle_ingreso_animals');
            $table->foreign('fincas_id')->references('id')->on('fincas');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('detalle_ingreso_animals2');
    }
}
