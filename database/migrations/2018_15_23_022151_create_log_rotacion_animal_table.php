<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogRotacionAnimalTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_rotacion_animal', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->date('fecha_rotacion')->nullable();
            $table->integer('potrero_inicial')->unsigned();
            $table->integer('potrero_final')->unsigned();
            $table->integer('peso_inicial')->unsigned();
            $table->integer('peso_final')->unsigned();
            $table->integer('ubicacion_animal_id')->unsigned();
            $table->integer('fincas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('potrero_inicial')->references('id')->on('potreros');
            $table->foreign('ubicacion_animal_id')->references('id')->on('ubicacion_animal');
            $table->foreign('potrero_final')->references('id')->on('potreros');
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
        Schema::drop('log_rotacion_animal');
    }
}
