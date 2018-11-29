<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstaditicaCompraTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estaditica_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fincas_id')->unsigned();
            $table->integer('tipo_ganados_id')->unsigned();
            $table->integer('id_registro_compras')->unsigned();
            $table->integer('id_compra_lote')->unsigned();
            $table->integer('precio_kilo')->unsigned();
            $table->integer('deduccion')->unsigned();
            $table->integer('deduccions_id')->unsigned();
            $table->string('descdeducion', 100);
            $table->float('numer_gan');
            $table->float('prome_peso');
            $table->float('peso_total');
            $table->float('valor_total');
            $table->float('valor_porce_deduc');
            $table->float('descuento');
            $table->float('valor_pagar');
            $table->timestamps();
            $table->foreign('fincas_id')->references('id')->on('fincas');
            $table->foreign('tipo_ganados_id')->references('id')->on('tipo_ganados');
            $table->foreign('id_registro_compras')->references('id')->on('registro_compras');
            $table->foreign('id_compra_lote')->references('id')->on('compra_lote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estaditica_compra');
    }
}
