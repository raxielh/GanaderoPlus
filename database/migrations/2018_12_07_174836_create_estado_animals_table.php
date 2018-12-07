<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstadoAnimalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_animals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100);
            $table->timestamps();
        });

        DB::table('estado_animals')->insert([
            'descripcion' => 'Activo',
        ]);
        DB::table('estado_animals')->insert([
            'descripcion' => 'Inactivo',
        ]);
        DB::table('estado_animals')->insert([
            'descripcion' => 'Muerto',
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estado_animals');
    }
}
