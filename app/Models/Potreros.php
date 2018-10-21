<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Potreros
 * @package App\Models
 * @version September 9, 2018, 10:35 pm UTC
 *
 * @property string codigo
 * @property string area
 * @property integer estado_id
 * @property integer fincas_id
 * @property integer users_id
 */
class Potreros extends Model
{
    

    public $table = 'potreros';
    

    


    public $fillable = [
        'codigo',
        'area',
        'estado_id',
        'fincas_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'codigo' => 'string',
        'area' => 'string',
        'estado_id' => 'integer',
        'fincas_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required',
        'area' => 'required',
        'estado_id' => 'required'
    ];

    
}
