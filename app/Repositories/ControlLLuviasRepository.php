<?php

namespace App\Repositories;

use App\Models\ControlLLuvias;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ControlLLuviasRepository
 * @package App\Repositories
 * @version October 11, 2018, 5:18 pm UTC
 *
 * @method ControlLLuvias findWithoutFail($id, $columns = ['*'])
 * @method ControlLLuvias find($id, $columns = ['*'])
 * @method ControlLLuvias first($columns = ['*'])
*/
class ControlLLuviasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'dia',
        'cantidad',
        'fincas_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ControlLLuvias::class;
    }
}
