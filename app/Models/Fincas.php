<?php
namespace App\Models;
use Eloquent as Model;
use Illuminate\Support\Facades\DB;


class Fincas extends Model
{
    
    public $table = 'fincas';
    
    
    public $fillable = [
        'id',
        'nombre',
        'descripcion',
        'lat',
        'lon',
        'users_id'
    ];

}