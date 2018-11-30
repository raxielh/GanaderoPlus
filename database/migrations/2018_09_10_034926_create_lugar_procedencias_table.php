<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLugarProcedenciasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lugar_procedencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100);
            $table->integer('fincas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('fincas_id')->references('id')->on('fincas');
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::table('lugar_procedencias')->insert([
            'descripcion' => 'Subastar',
            'fincas_id' => '1',
            'users_id' => 1,
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lugar_procedencias');
    }
}
