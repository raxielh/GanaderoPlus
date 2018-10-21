<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHierrosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hierros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hierro', 500);
            $table->integer('fincas_id')->unsigned();
            $table->foreign('fincas_id')->references('id')->on('fincas');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
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
        Schema::drop('hierros');
    }
}
