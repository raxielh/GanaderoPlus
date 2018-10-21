<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnidadesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100);
            $table->string('corta', 100);
            $table->timestamps();
        });
        
        DB::table('unidades')->insert([
            'descripcion' => 'Litro',
            'corta' => 'lt',
        ]);
        
        DB::table('unidades')->insert([
            'descripcion' => 'Mililitro',
            'corta' => 'mm',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('unidades');
    }
}
