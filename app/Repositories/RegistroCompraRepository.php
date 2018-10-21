<?php

namespace App\Repositories;

use App\Models\RegistroCompra;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RegistroCompraRepository
 * @package App\Repositories
 * @version September 10, 2018, 7:31 pm UTC
 *
 * @method RegistroCompra findWithoutFail($id, $columns = ['*'])
 * @method RegistroCompra find($id, $columns = ['*'])
 * @method RegistroCompra first($columns = ['*'])
*/
class RegistroCompraRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha_compra',
        'fecha_ingreso',
        'lugar_procedencia_id',
        'vendedor_id',
        'comprador_id',
        'responsable_id',
        'estado_id',
        'hierro_id',
        'fincas_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RegistroCompra::class;
    }
}
