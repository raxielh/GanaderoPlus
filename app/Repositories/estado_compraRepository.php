<?php

namespace App\Repositories;

use App\Models\estado_compra;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class estado_compraRepository
 * @package App\Repositories
 * @version September 10, 2018, 12:02 am UTC
 *
 * @method estado_compra findWithoutFail($id, $columns = ['*'])
 * @method estado_compra find($id, $columns = ['*'])
 * @method estado_compra first($columns = ['*'])
*/
class estado_compraRepository extends BaseRepository
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
        return estado_compra::class;
    }
}
