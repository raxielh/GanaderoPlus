<?php

namespace App\Repositories;

use App\Models\ResponsableCompras;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ResponsableComprasRepository
 * @package App\Repositories
 * @version September 10, 2018, 6:29 pm UTC
 *
 * @method ResponsableCompras findWithoutFail($id, $columns = ['*'])
 * @method ResponsableCompras find($id, $columns = ['*'])
 * @method ResponsableCompras first($columns = ['*'])
*/
class ResponsableComprasRepository extends BaseRepository
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
        return ResponsableCompras::class;
    }
}
