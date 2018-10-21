<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class EstadoProtrero
 * @package App\Models
 * @version September 9, 2018, 10:18 pm UTC
 *
 * @property string descripcion
 */
class EstadoProtrero extends Model
{
    

    public $table = 'estado_protreros';
    

    


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
