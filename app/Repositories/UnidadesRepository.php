<?php

namespace App\Repositories;

use App\Models\Unidades;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UnidadesRepository
 * @package App\Repositories
 * @version October 12, 2018, 1:43 am UTC
 *
 * @method Unidades findWithoutFail($id, $columns = ['*'])
 * @method Unidades find($id, $columns = ['*'])
 * @method Unidades first($columns = ['*'])
*/
class UnidadesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'corta'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Unidades::class;
    }
}
