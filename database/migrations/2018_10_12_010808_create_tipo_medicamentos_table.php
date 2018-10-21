<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatetipomedicamentosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_medicamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100);
            $table->timestamps();
        });
        DB::table('tipo_medicamentos')->insert([
            'descripcion' => 'Desparasitante',
        ]);
        
        DB::table('tipo_medicamentos')->insert([
            'descripcion' => 'Vitamina',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipo_medicamentos');
    }
}
