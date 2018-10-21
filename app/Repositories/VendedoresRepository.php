<?php

namespace App\Repositories;

use App\Models\Vendedores;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class VendedoresRepository
 * @package App\Repositories
 * @version September 10, 2018, 6:25 pm UTC
 *
 * @method Vendedores findWithoutFail($id, $columns = ['*'])
 * @method Vendedores find($id, $columns = ['*'])
 * @method Vendedores first($columns = ['*'])
*/
class VendedoresRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'identificacion',
        'direccion',
        'contacto',
        'fincas_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Vendedores::class;
    }
}
