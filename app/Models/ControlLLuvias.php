<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ControlLLuvias
 * @package App\Models
 * @version October 11, 2018, 5:18 pm UTC
 *
 * @property string dia
 * @property string cantidad
 * @property integer fincas_id
 * @property integer users_id
 */
class ControlLLuvias extends Model
{

    public $table = 'control_l_luvias';
    


    public $fillable = [
        'dia',
        'cantidad',
        'fincas_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'dia' => 'string',
        'cantidad' => 'string',
        'fincas_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dia' => 'required',
        'cantidad' => 'required'
    ];

    
}
