<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Hierro
 * @package App\Models
 * @version September 10, 2018, 5:20 pm UTC
 *
 * @property string hierro
 * @property integer fincas_id
 */
class Hierro extends Model
{
    

    public $table = 'hierros';
    

    


    public $fillable = [
        'hierro',
        'fincas_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'hierro' => 'string',
        'fincas_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'hierro' => 'required'
    ];

    
}
