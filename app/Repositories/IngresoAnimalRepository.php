<?php

namespace App\Repositories;

use App\Models\IngresoAnimal;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class IngresoAnimalRepository
 * @package App\Repositories
 * @version October 22, 2018, 2:21 am UTC
 *
 * @method IngresoAnimal findWithoutFail($id, $columns = ['*'])
 * @method IngresoAnimal find($id, $columns = ['*'])
 * @method IngresoAnimal first($columns = ['*'])
*/
class IngresoAnimalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha',
        'potreros_id',
        'registro_compra_id',
        'fincas_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return IngresoAnimal::class;
    }
}
