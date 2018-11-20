<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePreguntalicenciasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta_licencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100);
            $table->timestamps();
        });

        DB::table('pregunta_licencias')->insert([
            'descripcion' => 'Si'
        ]);
        
        DB::table('pregunta_licencias')->insert([
            'descripcion' => 'No'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pregunta_licencias');
    }
}
