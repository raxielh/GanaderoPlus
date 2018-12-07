<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUbicacionAnimalTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicacion_animal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('observaciones', 200)->nullable();
            $table->integer('peso')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->integer('potreros_id')->unsigned();
            $table->integer('detalle_ingreso_animals2_id')->unsigned();
            $table->integer('fincas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('detalle_ingreso_animals2_id')->references('id')->on('detalle_ingreso_animals2');
            $table->foreign('potreros_id')->references('id')->on('potreros');
            $table->foreign('estado_id')->references('id')->on('estado_animals');
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
        Schema::drop('ubicacion_animal');
    }
}
