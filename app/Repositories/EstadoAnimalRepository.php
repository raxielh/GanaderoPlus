<?php

namespace App\Repositories;

use App\Models\EstadoAnimal;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EstadoAnimalRepository
 * @package App\Repositories
 * @version December 7, 2018, 5:48 pm UTC
 *
 * @method EstadoAnimal findWithoutFail($id, $columns = ['*'])
 * @method EstadoAnimal find($id, $columns = ['*'])
 * @method EstadoAnimal first($columns = ['*'])
*/
class EstadoAnimalRepository extends BaseRepository
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
        return EstadoAnimal::class;
    }
}
