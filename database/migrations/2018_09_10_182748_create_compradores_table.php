<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompradoresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compradores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->string('identificacion', 100);
            $table->string('direccion', 100);
            $table->string('contacto', 100);
            $table->integer('fincas_id')->unsigned();
            $table->foreign('fincas_id')->references('id')->on('fincas');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
            $table->timestamps();
        });
        DB::table('compradores')->insert([
            'nombre' => 'Cristian Hoyos',
            'identificacion' => '1067879307',
            'direccion' => 'cr 8c',
            'contacto' => '310676',
            'fincas_id' => '1',
            'users_id' => '1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('compradores');
    }
}
