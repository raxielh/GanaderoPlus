<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicamentosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100);
            $table->integer('precio');
            $table->integer('presentacion_id')->unsigned();
            $table->integer('unidad_id')->unsigned();
            $table->integer('tipo_medicamentos_id')->unsigned();
            $table->integer('fincas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('presentacion_id')->references('id')->on('presentacions');
            $table->foreign('unidad_id')->references('id')->on('unidades');
            $table->foreign('tipo_medicamentos_id')->references('id')->on('tipo_medicamentos');
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
        Schema::drop('medicamentos');
    }
}
