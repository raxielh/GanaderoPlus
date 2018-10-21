<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class tipo_medicamentos
 * @package App\Models
 * @version October 12, 2018, 1:08 am UTC
 *
 * @property string descripcion
 */
class tipo_medicamentos extends Model
{

    public $table = 'tipo_medicamentos';
    


    public $fillable = [
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required'
    ];

    
}
