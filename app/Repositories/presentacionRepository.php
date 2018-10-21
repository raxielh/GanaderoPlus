<?php

namespace App\Repositories;

use App\Models\presentacion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class presentacionRepository
 * @package App\Repositories
 * @version October 12, 2018, 2:41 am UTC
 *
 * @method presentacion findWithoutFail($id, $columns = ['*'])
 * @method presentacion find($id, $columns = ['*'])
 * @method presentacion first($columns = ['*'])
*/
class presentacionRepository extends BaseRepository
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
        return presentacion::class;
    }
}
