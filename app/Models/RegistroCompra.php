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
        'factura',
        'estado_id',
        'lugar_procedencia_id',
        'numero_compra',
        'pregunta_facturas_id',
        'documento_factura',
        'vendedor_id',
        'comprador_id',
        'tipo_compras_id',
        'empresas_id',
        'pregunta_licencias_id',
        'codigo',
        'documento',
        'fincas_id',  
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha_compra' => 'date',
        'factura' => 'string',
        'numero_compra'=> 'integer',
        'pregunta_facturas_id'=> 'integer',
        'documento_factura'=> 'string',
        'estado_id' => 'integer',
        'lugar_procedencia_id' => 'integer',
        'vendedor_id' => 'integer',
        'comprador_id' => 'integer',   
        'tipo_compras_id' => 'integer',
        'pregunta_licencias_id' => 'integer',
        'codigo' => 'string',
        'documento' => 'string',
        'empresas_id' => 'integer',        
        'fincas_id' => 'integer',
        'users_id' => 'integer',
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fecha_compra' => 'required',
        'lugar_procedencia_id' => 'required',
        'vendedor_id' => 'required',
        'comprador_id' => 'required',
        'tipo_compras_id' => 'required',   
        'empresas_id' => 'required',
        'estado_id' => 'required',
        'numero_compra'=> 'required',
        'pregunta_facturas_id'=> 'required',
    ];

    
}
