<?php

namespace App\Repositories;

use App\Models\Pregunta_licencia;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Pregunta_licenciaRepository
 * @package App\Repositories
 * @version November 20, 2018, 8:36 pm UTC
 *
 * @method Pregunta_licencia findWithoutFail($id, $columns = ['*'])
 * @method Pregunta_licencia find($id, $columns = ['*'])
 * @method Pregunta_licencia first($columns = ['*'])
*/
class Pregunta_licenciaRepository extends BaseRepository
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
        return Pregunta_licencia::class;
    }
}
