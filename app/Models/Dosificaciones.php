<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Dosificaciones
 * @package App\Models
 * @version October 12, 2018, 3:49 am UTC
 *
 * @property string peso_inicial
 * @property string peso_final
 * @property string dosis
 * @property integer medicamento_id
 * @property integer fincas_id
 * @property integer users_id
 */
class Dosificaciones extends Model
{

    public $table = 'dosificaciones';
    


    public $fillable = [
        'peso_inicial',
        'peso_final',
        'dosis',
        'medicamento_id',
        'fincas_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'peso_inicial' => 'string',
        'peso_final' => 'string',
        'dosis' => 'string',
        'medicamento_id' => 'integer',
        'fincas_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'peso_inicial' => 'required',
        'peso_final' => 'required',
        'dosis' => 'required'
    ];

    
}
