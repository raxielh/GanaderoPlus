<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePregunta_licenciaRequest;
use App\Http\Requests\UpdatePregunta_licenciaRequest;
use App\Repositories\Pregunta_licenciaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use Session;
use Response;

class Pregunta_licenciaController extends AppBaseController
{
    /** @var  Pregunta_licenciaRepository */
    private $preguntaLicenciaRepository;

    public function __construct(Pregunta_licenciaRepository $preguntaLicenciaRepo)
    {
        $this->preguntaLicenciaRepository = $preguntaLicenciaRepo;
    }

    /**
     * Display a listing of the Pregunta_licencia.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->preguntaLicenciaRepository->pushCriteria(new RequestCriteria($request));
        $preguntaLicencias = $this->preguntaLicenciaRepository->all();

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('pregunta_licencias.index')
            ->with('preguntaLicencias', $preguntaLicencias)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new Pregunta_licencia.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('pregunta_licencias.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created Pregunta_licencia in storage.
     *
     * @param CreatePregunta_licenciaRequest $request
     *
     * @return Response
     */
    public function store(CreatePregunta_licenciaRequest $request)
    {
        $input = $request->all();

        $preguntaLicencia = $this->preguntaLicenciaRepository->create($input);

        Flash::success('Pregunta Licencia Guardado exitosamente.');

        return redirect(route('preguntaLicencias.index'));
    }

    /**
     * Display the specified Pregunta_licencia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $preguntaLicencia = $this->preguntaLicenciaRepository->findWithoutFail($id);

        if (empty($preguntaLicencia)) {
            Flash::error('Pregunta Licencia not found');

            return redirect(route('preguntaLicencias.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('pregunta_licencias.show')->with('preguntaLicencia', $preguntaLicencia)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified Pregunta_licencia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $preguntaLicencia = $this->preguntaLicenciaRepository->findWithoutFail($id);

        if (empty($preguntaLicencia)) {
            Flash::error('Pregunta Licencia not found');

            return redirect(route('preguntaLicencias.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('pregunta_licencias.edit')->with('preguntaLicencia', $preguntaLicencia)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified Pregunta_licencia in storage.
     *
     * @param  int              $id
     * @param UpdatePregunta_licenciaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePregunta_licenciaRequest $request)
    {
        $preguntaLicencia = $this->preguntaLicenciaRepository->findWithoutFail($id);

        if (empty($preguntaLicencia)) {
            Flash::error('Pregunta Licencia not found');

            return redirect(route('preguntaLicencias.index'));
        }

        $preguntaLicencia = $this->preguntaLicenciaRepository->update($request->all(), $id);

        Flash::success('Pregunta Licencia Actualizado con exito.');

        return redirect(route('preguntaLicencias.index'));
    }

    /**
     * Remove the specified Pregunta_licencia from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $preguntaLicencia = $this->preguntaLicenciaRepository->findWithoutFail($id);

        if (empty($preguntaLicencia)) {
            Flash::error('Pregunta Licencia not found');

            return redirect(route('preguntaLicencias.index'));
        }

        $this->preguntaLicenciaRepository->delete($id);

        Flash::success('Pregunta Licencia Borrado con exito.');

        return redirect(route('preguntaLicencias.index'));
    }
}
