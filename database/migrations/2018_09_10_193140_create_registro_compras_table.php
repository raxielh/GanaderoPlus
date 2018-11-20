<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistroComprasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_compras', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_compra', 100);
            $table->integer('deduccion')->unsigned();
            $table->integer('factura')->unsigned();
            $table->integer('lugar_procedencia_id')->unsigned();
            $table->integer('tipo_compras_id')->unsigned();
            $table->integer('empresas_id')->unsigned();
            $table->integer('deduccions_id')->unsigned();
            $table->integer('vendedor_id')->unsigned();
            $table->integer('comprador_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->integer('fincas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('deduccions_id')->references('id')->on('deduccions');
            $table->foreign('lugar_procedencia_id')->references('id')->on('lugar_procedencias');
            $table->foreign('tipo_compras_id')->references('id')->on('tipo_compras');
            $table->foreign('empresas_id')->references('id')->on('empresas');
            $table->foreign('vendedor_id')->references('id')->on('vendedores');
            $table->foreign('comprador_id')->references('id')->on('compradores');
            $table->foreign('estado_id')->references('id')->on('estado_compras');
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
        Schema::drop('registro_compras');
    }
}
