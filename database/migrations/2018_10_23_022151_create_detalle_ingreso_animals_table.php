<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetalleIngresoAnimalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ingreso_animals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('observaciones', 200)->nullable();
            $table->integer('registro_compra_lote_id')->unsigned();
            $table->integer('potreros_id')->unsigned();
            $table->integer('tipo_ganados_id')->unsigned();
            $table->integer('fincas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('potreros_id')->references('id')->on('potreros');
            $table->foreign('registro_compra_lote_id')->references('id')->on('ingreso_animals');
            $table->foreign('tipo_ganados_id')->references('id')->on('tipo_ganados');
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
        Schema::drop('detalle_ingreso_animals');
    }
}
