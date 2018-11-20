<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pregunta_licencia
 * @package App\Models
 * @version November 20, 2018, 8:36 pm UTC
 *
 * @property string descripcion
 */
class Pregunta_licencia extends Model
{

    public $table = 'pregunta_licencias';
    


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
