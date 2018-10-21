<?php

namespace App\Repositories;

use App\Models\CompraMedicamento;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CompraMedicamentoRepository
 * @package App\Repositories
 * @version October 12, 2018, 1:43 pm UTC
 *
 * @method CompraMedicamento findWithoutFail($id, $columns = ['*'])
 * @method CompraMedicamento find($id, $columns = ['*'])
 * @method CompraMedicamento first($columns = ['*'])
*/
class CompraMedicamentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'precio',
        'cantidad',
        'fecha',
        'medicamento_id',
        'fincas_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CompraMedicamento::class;
    }
}
