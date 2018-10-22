<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoGanadosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_ganados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100);
            $table->string('descripcion_corta', 100);
            $table->timestamps();
        });
        DB::table('tipo_ganados')->insert([
            'descripcion' => 'Macho de Levante',
            'descripcion_corta' => 'ML',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipo_ganados');
    }
}
