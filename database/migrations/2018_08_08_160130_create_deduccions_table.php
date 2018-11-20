<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatededuccionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deduccions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('deduccions')->insert([
            'descripcion' => 'Porcentaje'
        ]);
        
        DB::table('deduccions')->insert([
            'descripcion' => 'Valor'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deduccions');
    }
}
