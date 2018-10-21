<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Medicamentos
 * @package App\Models
 * @version October 12, 2018, 1:21 am UTC
 *
 * @property string descripcion
 * @property integer tipo_medicamentos_id
 * @property integer valor
 * @property string presentacion
 * @property string unidad
 * @property integer fincas_id
 * @property integer users_id
 */
class Medicamentos extends Model
{

    public $table = 'medicamentos';
    


    public $fillable = [
        'descripcion',
        'tipo_medicamentos_id',
        'precio',
        'presentacion_id',
        'unidad_id',
        'fincas_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'descripcion' => 'string',
        'tipo_medicamentos_id' => 'integer',
        'precio' => 'integer',
        'presentacion_id' => 'integer',
        'unidad_id' => 'integer',
        'fincas_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required',
        'tipo_medicamentos_id' => 'required',
        'precio' => 'required',
        'presentacion_id' => 'required',
        'unidad_id' => 'required'
    ];

    
}
