<?php

namespace App\Repositories;

use App\Models\TipoGanado;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TipoGanadoRepository
 * @package App\Repositories
 * @version October 5, 2018, 2:46 pm UTC
 *
 * @method TipoGanado findWithoutFail($id, $columns = ['*'])
 * @method TipoGanado find($id, $columns = ['*'])
 * @method TipoGanado first($columns = ['*'])
*/
class TipoGanadoRepository extends BaseRepository
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
        return TipoGanado::class;
    }
}
