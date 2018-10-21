<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class estado_compra
 * @package App\Models
 * @version September 10, 2018, 12:02 am UTC
 *
 * @property string descripcion
 */
class estado_compra extends Model
{
    

    public $table = 'estado_compras';
    

    


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
