<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class TipoGanado
 * @package App\Models
 * @version October 5, 2018, 2:46 pm UTC
 *
 * @property string descripcion
 */
class TipoGanado extends Model
{
    

    public $table = 'tipo_ganados';
    

    


    public $fillable = [
        'descripcion',
        'descripcion_corta'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'descripcion' => 'string',
        'descripcion_corta' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required',
        'descripcion_corta'  => 'required'
    ];

    
}
