<?php

namespace App\Repositories;

use App\Models\PreguntaFacturas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PreguntaFacturasRepository
 * @package App\Repositories
 * @version November 27, 2018, 6:54 pm UTC
 *
 * @method PreguntaFacturas findWithoutFail($id, $columns = ['*'])
 * @method PreguntaFacturas find($id, $columns = ['*'])
 * @method PreguntaFacturas first($columns = ['*'])
*/
class PreguntaFacturasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PreguntaFacturas::class;
    }
}
