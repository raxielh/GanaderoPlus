<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompraLoteTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_lote', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_ganados_id')->unsigned();
            $table->integer('cantidad')->nullable();
            $table->integer('precio')->unsigned();
            $table->integer('fincas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->integer('compra_lote_id')->unsigned();
            $table->integer('estado_lote_id')->unsigned();
            $table->string('observaciones', 200)->nullable();
            $table->integer('deduccions_id')->unsigned();
            $table->float('deduccion');
            $table->integer('factura')->nullable();
            $table->integer('pregunta_facturas_id')->unsigned();
            $table->string('documento_factura', 199)->nullable();
            $table->foreign('tipo_ganados_id')->references('id')->on('tipo_ganados');
            $table->foreign('deduccions_id')->references('id')->on('deduccions');
            $table->foreign('pregunta_facturas_id')->references('id')->on('pregunta_facturas');
            $table->foreign('fincas_id')->references('id')->on('fincas');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('compra_lote_id')->references('id')->on('registro_compras');
            $table->foreign('estado_lote_id')->references('id')->on('estado_lote');
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
        Schema::drop('compra_lote');
    }
}
