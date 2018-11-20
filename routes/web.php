<?php

Auth::routes();
Route::get('/', function () { return redirect('/login'); });
Route::get('/register', function () { return redirect('/login');});

Route::get('/home', 'HomeController@index')->name('fincas');
Route::post('fincas', 'FincasController@store')->name('crear_finca');
Route::post('fincas_update', 'FincasController@update')->name('update_finca');
Route::delete('fincas_borrar/{id}', 'FincasController@delete')->name('fincas.destroy');
Route::post('elegir_finca', 'FincasController@elegir_finca')->name('elegir_finca');
Route::get('/app', 'MainController@index')->name('app');

/* Estados */
Route::resource('estadoProtreros', 'EstadoProtreroController');
Route::resource('estadoCompras', 'estado_compraController');
/* Fin Estados */

Route::resource('potreros', 'PotrerosController');
Route::resource('registroCompras', 'RegistroCompraController');
Route::resource('lugarProcedencias', 'LugarProcedenciaController');
Route::resource('hierros', 'HierroController');
Route::resource('vendedores', 'VendedoresController');
Route::resource('compradores', 'CompradoresController');
Route::resource('responsableCompras', 'ResponsableComprasController');

/* Estados registroCompras */
Route::resource('registroCompras', 'RegistroCompraController');
Route::get('/registroCompras/ficha/{id}/ver', 'RegistroCompraController@add_ficha');
Route::post('registroCompras/add_lote', 'RegistroCompraController@add_lote')->name('add_lote');
Route::post('registroCompras/add_lote_ganado', 'RegistroCompraController@add_lote_ganado')->name('add_lote_ganado');
Route::delete('registroCompras/delete_lote/{id}', 'RegistroCompraController@delete_lote')->name('lote.destroy');
Route::delete('registroCompras/delete_animal/{id}', 'RegistroCompraController@delete_animal')->name('animal.destroy');
/* Fin registroCompras */

Route::resource('tipoGanados', 'TipoGanadoController');
Route::resource('tipoCompra', 'TipoCompraController');

Route::resource('empresas', 'EmpresaController');

Route::resource('controlLLuvias', 'ControlLLuviasController');
Route::get('/controlLLuvias_resumen', 'ControlLLuviasController@resumen')->name('controlLLuvias.resumen');

Route::resource('tipoMedicamentos', 'tipo_medicamentosController');

Route::resource('medicamentos', 'MedicamentosController');
Route::get('medicamento/historial/{id}', 'MedicamentosController@historial')->name('medicamento.historial');

Route::resource('unidades', 'UnidadesController');

Route::resource('presentacions', 'presentacionController');

Route::resource('dosificaciones', 'DosificacionesController');

Route::resource('compraMedicamentos', 'CompraMedicamentoController');

Route::get('api/buscar/precio/medicamento/{id}', 'MedicamentosController@buscar_precio');

Route::resource('ingresoAnimals', 'IngresoAnimalController');
Route::post('ingresoAnimals/ingreso', 'IngresoAnimalController@ingreso')->name('ingresar_ganado');
Route::delete('ingresoAnimals/ingreso/{id}', 'IngresoAnimalController@delete_ingreso')->name('ingreso.destroy');



















Route::resource('deduccions', 'deduccionController');

Route::resource('deduccions', 'deduccionController');