<?php

namespace App\Repositories;

use App\Models\deduccion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class deduccionRepository
 * @package App\Repositories
 * @version November 20, 2018, 4:01 pm UTC
 *
 * @method deduccion findWithoutFail($id, $columns = ['*'])
 * @method deduccion find($id, $columns = ['*'])
 * @method deduccion first($columns = ['*'])
*/
class deduccionRepository extends BaseRepository
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
        return deduccion::class;
    }
}
