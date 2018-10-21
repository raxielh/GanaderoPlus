<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class RegistroCompra
 * @package App\Models
 * @version September 10, 2018, 7:31 pm UTC
 *
 * @property date fecha_compra
 * @property date fecha_ingreso
 * @property integer lugar_procedencia_id
 * @property integer vendedor_id
 * @property integer comprador_id
 * @property integer responsable_id
 * @property integer estado_id
 * @property integer hierro_id
 * @property integer fincas_id
 * @property integer users_id
 */
class RegistroCompra extends Model
{
    

    public $table = 'registro_compras';
    

    


    public $fillable = [
        'fecha_compra',
        'fecha_ingreso',
        'deduccion',
        'lugar_procedencia_id',
        'vendedor_id',
        'comprador_id',
        'responsable_id',
        'estado_id',
        'hierro_id',
        'fincas_id',
        'factura',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha_compra' => 'date',
        'fecha_ingreso' => 'date',
        'deduccion' => 'integer',
        'lugar_procedencia_id' => 'integer',
        'vendedor_id' => 'integer',
        'comprador_id' => 'integer',
        'responsable_id' => 'integer',
        'estado_id' => 'integer',
        'hierro_id' => 'integer',
        'fincas_id' => 'integer',
        'users_id' => 'integer',
        'factura' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fecha_compra' => 'required',
        'fecha_ingreso' => 'required',
        'deduccion' => 'required',
        'lugar_procedencia_id' => 'required',
        'vendedor_id' => 'required',
        'comprador_id' => 'required',
        'responsable_id' => 'required',
        'estado_id' => 'required',
        'hierro_id' => 'required',
        'factura' => 'required',
    ];

    
}
