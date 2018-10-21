<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Empresa
 * @package App\Models
 * @version October 11, 2018, 3:50 pm UTC
 *
 * @property string nit
 * @property string razon_social
 * @property string direccion
 * @property string telefono
 * @property string logo
 * @property integer fincas_id
 * @property integer users_id
 */
class Empresa extends Model
{

    public $table = 'empresas';
    


    public $fillable = [
        'nit',
        'razon_social',
        'direccion',
        'telefono',
        'logo',
        'fincas_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nit' => 'string',
        'razon_social' => 'string',
        'direccion' => 'string',
        'telefono' => 'string',
        'logo' => 'string',
        'fincas_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nit' => 'required',
        'razon_social' => 'required'
    ];

    
}
