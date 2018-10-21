<?php

namespace App\Repositories;

use App\Models\Hierro;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HierroRepository
 * @package App\Repositories
 * @version September 10, 2018, 5:20 pm UTC
 *
 * @method Hierro findWithoutFail($id, $columns = ['*'])
 * @method Hierro find($id, $columns = ['*'])
 * @method Hierro first($columns = ['*'])
*/
class HierroRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hierro',
        'fincas_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Hierro::class;
    }
}
