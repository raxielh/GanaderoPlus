<?php

namespace App\Repositories;

use App\Models\EstadoProtrero;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EstadoProtreroRepository
 * @package App\Repositories
 * @version September 9, 2018, 10:18 pm UTC
 *
 * @method EstadoProtrero findWithoutFail($id, $columns = ['*'])
 * @method EstadoProtrero find($id, $columns = ['*'])
 * @method EstadoProtrero first($columns = ['*'])
*/
class EstadoProtreroRepository extends BaseRepository
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
        return EstadoProtrero::class;
    }
}
