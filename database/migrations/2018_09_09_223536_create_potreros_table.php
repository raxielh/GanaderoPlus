<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePotrerosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potreros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 100);
            $table->integer('area');
            $table->integer('cantidad_max');
            $table->integer('estado_id')->unsigned();
            $table->integer('fincas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('estado_id')->references('id')->on('estado_protreros');
            $table->foreign('fincas_id')->references('id')->on('fincas');
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::table('potreros')->insert([
            'codigo' => 'Potrero 1',
            'area' => '120',
            'cantidad_max' => '30',
            'estado_id' => '1',
            'fincas_id' => '1',
            'users_id' => '1',
        ]);
        DB::table('potreros')->insert([
            'codigo' => 'Potrero 2',
            'area' => '170',
            'cantidad_max' => '30',
            'estado_id' => '1',
            'fincas_id' => '1',
            'users_id' => '1',
        ]);
        DB::table('potreros')->insert([
            'codigo' => 'Potrero 3',
            'area' => '220',
            'cantidad_max' => '30',
            'estado_id' => '1',
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
        Schema::drop('potreros');
    }
}
