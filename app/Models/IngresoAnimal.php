<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class IngresoAnimal
 * @package App\Models
 * @version October 22, 2018, 2:21 am UTC
 *
 * @property date fecha
 * @property integer potreros_id
 * @property integer registro_compra_id
 * @property integer fincas_id
 * @property integer users_id
 */
class IngresoAnimal extends Model
{

    public $table = 'ingreso_animals';
    


    public $fillable = [
        'fecha',
        'potreros_id',
        'registro_compra_id',
        'fincas_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha' => 'date',
        'potreros_id' => 'integer',
        'registro_compra_id' => 'integer',
        'fincas_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fecha' => 'required',
        'potreros_id' => 'required',
        'registro_compra_id' => 'required'
    ];

    
}
