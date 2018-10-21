<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class ResponsableCompras
 * @package App\Models
 * @version September 10, 2018, 6:29 pm UTC
 *
 * @property string nombre
 * @property string identificacion
 * @property string direccion
 * @property string contacto
 * @property integer fincas_id
 */
class ResponsableCompras extends Model
{
    

    public $table = 'responsable_compras';
    

    


    public $fillable = [
        'nombre',
        'identificacion',
        'direccion',
        'contacto',
        'fincas_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'identificacion' => 'string',
        'direccion' => 'string',
        'contacto' => 'string',
        'fincas_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'identificacion' => 'required',
        'direccion' => 'required',
        'contacto' => 'required'
    ];

    
}
