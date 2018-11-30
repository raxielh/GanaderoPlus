<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nit', 100);
            $table->string('razon_social', 100);
            $table->string('direccion', 100)->nullable();
            $table->string('telefono', 100)->nullable();
            $table->string('logo', 250)->nullable();
            $table->integer('fincas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('fincas_id')->references('id')->on('fincas');
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::table('empresas')->insert([
            'nit' => '678686',
            'razon_social' => 'Empresa EJEMPLO',
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
        Schema::drop('empresas');
    }
}
