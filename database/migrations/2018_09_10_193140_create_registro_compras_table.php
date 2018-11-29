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
            $table->integer('numero_compra')->unsigned();
            $table->date('fecha_compra', 100);           
            $table->integer('factura')->nullable();
            $table->string('codigo', 100)->nullable();
            $table->string('documento', 199)->nullable();
            $table->string('documento_factura', 199)->nullable();
            $table->integer('lugar_procedencia_id')->unsigned();
            $table->integer('tipo_compras_id')->unsigned();
            $table->integer('empresas_id')->unsigned();
            $table->integer('pregunta_licencias_id')->unsigned();
            $table->integer('pregunta_facturas_id')->unsigned();
            $table->integer('vendedor_id')->unsigned();
            $table->integer('comprador_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->integer('fincas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('pregunta_facturas_id')->references('id')->on('pregunta_facturas');
            $table->foreign('pregunta_licencias_id')->references('id')->on('pregunta_licencias');
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
