<?php

namespace App\Repositories;

use App\Models\Empresa;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EmpresaRepository
 * @package App\Repositories
 * @version October 11, 2018, 3:50 pm UTC
 *
 * @method Empresa findWithoutFail($id, $columns = ['*'])
 * @method Empresa find($id, $columns = ['*'])
 * @method Empresa first($columns = ['*'])
*/
class EmpresaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nit',
        'razon_social',
        'direccion',
        'telefono',
        'logo',
        'fincas_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Empresa::class;
    }
}
