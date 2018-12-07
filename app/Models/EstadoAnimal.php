<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EstadoAnimal
 * @package App\Models
 * @version December 7, 2018, 5:48 pm UTC
 *
 * @property string descripcion
 */
class EstadoAnimal extends Model
{

    public $table = 'estado_animals';
    


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
