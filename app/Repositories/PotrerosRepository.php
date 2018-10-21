<?php

namespace App\Repositories;

use App\Models\Potreros;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PotrerosRepository
 * @package App\Repositories
 * @version September 9, 2018, 10:35 pm UTC
 *
 * @method Potreros findWithoutFail($id, $columns = ['*'])
 * @method Potreros find($id, $columns = ['*'])
 * @method Potreros first($columns = ['*'])
*/
class PotrerosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'area',
        'estado_id',
        'fincas_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Potreros::class;
    }
}
