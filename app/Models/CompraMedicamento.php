<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CompraMedicamento
 * @package App\Models
 * @version October 12, 2018, 1:43 pm UTC
 *
 * @property integer precio
 * @property integer cantidad
 * @property date fecha
 * @property integer medicamento_id
 * @property integer fincas_id
 * @property integer users_id
 */
class CompraMedicamento extends Model
{

    public $table = 'compra_medicamentos';
    


    public $fillable = [
        'precio',
        'cantidad',
        'fecha',
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
        'precio' => 'integer',
        'cantidad' => 'integer',
        'fecha' => 'date',
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
        'precio' => 'required',
        'cantidad' => 'required',
        'fecha' => 'required',
        'medicamento_id' => 'required'
    ];

    
}
