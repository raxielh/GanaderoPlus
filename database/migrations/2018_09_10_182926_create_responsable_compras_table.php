<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResponsableComprasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsable_compras', function (Blueprint $table) {
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
        DB::table('responsable_compras')->insert([
            'nombre' => 'Julio Hoyos',
            'identificacion' => '1067879304',
            'direccion' => 'cr 8c',
            'contacto' => '310676',
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
        Schema::drop('responsable_compras');
    }
}
