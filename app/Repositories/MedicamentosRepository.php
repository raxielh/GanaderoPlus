<?php

namespace App\Repositories;

use App\Models\Medicamentos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MedicamentosRepository
 * @package App\Repositories
 * @version October 12, 2018, 1:21 am UTC
 *
 * @method Medicamentos findWithoutFail($id, $columns = ['*'])
 * @method Medicamentos find($id, $columns = ['*'])
 * @method Medicamentos first($columns = ['*'])
*/
class MedicamentosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'tipo_medicamentos_id',
        'valor',
        'presentacion',
        'unidad',
        'fincas_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Medicamentos::class;
    }
}
