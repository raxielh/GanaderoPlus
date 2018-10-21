<?php

namespace App\Repositories;

use App\Models\Compradores;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CompradoresRepository
 * @package App\Repositories
 * @version September 10, 2018, 6:27 pm UTC
 *
 * @method Compradores findWithoutFail($id, $columns = ['*'])
 * @method Compradores find($id, $columns = ['*'])
 * @method Compradores first($columns = ['*'])
*/
class CompradoresRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'identificacion',
        'direccion',
        'contacto',
        'fincas_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Compradores::class;
    }
}
