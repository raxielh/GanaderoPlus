<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class LugarProcedencia
 * @package App\Models
 * @version September 10, 2018, 3:49 am UTC
 *
 * @property string descripcion
 * @property integer fincas_id
 * @property integer users_id
 */
class LugarProcedencia extends Model
{
    

    public $table = 'lugar_procedencias';
    

    


    public $fillable = [
        'descripcion',
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
        'fincas_id' => 'integer',
        'users_id' => 'integer'
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
