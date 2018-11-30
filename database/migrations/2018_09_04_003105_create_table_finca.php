<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFinca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fincas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            //$table->string('hierro')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
            $table->timestamps();
        });

        DB::table('fincas')->insert([
            'nombre' => 'Prueba',
            'descripcion' => 'Finca de Prueba',
            'lat' => '8.768501',
            'lon' => '-75.886583',
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
        Schema::dropIfExists('fincas');
    }
}
