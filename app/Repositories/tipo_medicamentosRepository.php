<?php

namespace App\Repositories;

use App\Models\tipo_medicamentos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class tipo_medicamentosRepository
 * @package App\Repositories
 * @version October 12, 2018, 1:08 am UTC
 *
 * @method tipo_medicamentos findWithoutFail($id, $columns = ['*'])
 * @method tipo_medicamentos find($id, $columns = ['*'])
 * @method tipo_medicamentos first($columns = ['*'])
*/
class tipo_medicamentosRepository extends BaseRepository
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
        return tipo_medicamentos::class;
    }
}
