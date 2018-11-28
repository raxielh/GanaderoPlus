<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PreguntaFacturas
 * @package App\Models
 * @version November 27, 2018, 6:54 pm UTC
 *
 * @property string descripcion
 */
class PreguntaFacturas extends Model
{

    public $table = 'pregunta_facturas';
    


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
