<?php

namespace App\Repositories;

use App\Models\LugarProcedencia;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LugarProcedenciaRepository
 * @package App\Repositories
 * @version September 10, 2018, 3:49 am UTC
 *
 * @method LugarProcedencia findWithoutFail($id, $columns = ['*'])
 * @method LugarProcedencia find($id, $columns = ['*'])
 * @method LugarProcedencia first($columns = ['*'])
*/
class LugarProcedenciaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'fincas_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LugarProcedencia::class;
    }
}
