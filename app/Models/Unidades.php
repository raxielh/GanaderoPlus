<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Unidades
 * @package App\Models
 * @version October 12, 2018, 1:43 am UTC
 *
 * @property string descripcion
 * @property string corta
 */
class Unidades extends Model
{

    public $table = 'unidades';
    


    public $fillable = [
        'descripcion',
        'corta'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'descripcion' => 'string',
        'corta' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required',
        'corta' => 'required'
    ];

    
}
