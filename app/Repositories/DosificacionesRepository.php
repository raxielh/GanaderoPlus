<?php

namespace App\Repositories;

use App\Models\Dosificaciones;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DosificacionesRepository
 * @package App\Repositories
 * @version October 12, 2018, 3:49 am UTC
 *
 * @method Dosificaciones findWithoutFail($id, $columns = ['*'])
 * @method Dosificaciones find($id, $columns = ['*'])
 * @method Dosificaciones first($columns = ['*'])
*/
class DosificacionesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'peso_inicial',
        'peso_final',
        'dosis',
        'medicamento_id',
        'fincas_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Dosificaciones::class;
    }
}
