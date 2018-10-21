<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createtipo_medicamentosRequest;
use App\Http\Requests\Updatetipo_medicamentosRequest;
use App\Repositories\tipo_medicamentosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use Session;
use Response;

class tipo_medicamentosController extends AppBaseController
{
    /** @var  tipo_medicamentosRepository */
    private $tipoMedicamentosRepository;

    public function __construct(tipo_medicamentosRepository $tipoMedicamentosRepo)
    {
        $this->tipoMedicamentosRepository = $tipoMedicamentosRepo;
    }

    /**
     * Display a listing of the tipo_medicamentos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoMedicamentosRepository->pushCriteria(new RequestCriteria($request));
        $tipoMedicamentos = $this->tipoMedicamentosRepository->all();

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('tipo_medicamentos.index')
            ->with('tipoMedicamentos', $tipoMedicamentos)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new tipo_medicamentos.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('tipo_medicamentos.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created tipo_medicamentos in storage.
     *
     * @param Createtipo_medicamentosRequest $request
     *
     * @return Response
     */
    public function store(Createtipo_medicamentosRequest $request)
    {
        $input = $request->all();

        $tipoMedicamentos = $this->tipoMedicamentosRepository->create($input);

        Flash::success('Tipo Medicamentos Guardado exitosamente.');

        return redirect(route('tipoMedicamentos.index'));
    }

    /**
     * Display the specified tipo_medicamentos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoMedicamentos = $this->tipoMedicamentosRepository->findWithoutFail($id);

        if (empty($tipoMedicamentos)) {
            Flash::error('Tipo Medicamentos not found');

            return redirect(route('tipoMedicamentos.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('tipo_medicamentos.show')->with('tipoMedicamentos', $tipoMedicamentos)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified tipo_medicamentos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoMedicamentos = $this->tipoMedicamentosRepository->findWithoutFail($id);

        if (empty($tipoMedicamentos)) {
            Flash::error('Tipo Medicamentos not found');

            return redirect(route('tipoMedicamentos.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('tipo_medicamentos.edit')->with('tipoMedicamentos', $tipoMedicamentos)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified tipo_medicamentos in storage.
     *
     * @param  int              $id
     * @param Updatetipo_medicamentosRequest $request
     *
     * @return Response
     */
    public function update($id, Updatetipo_medicamentosRequest $request)
    {
        $tipoMedicamentos = $this->tipoMedicamentosRepository->findWithoutFail($id);

        if (empty($tipoMedicamentos)) {
            Flash::error('Tipo Medicamentos not found');

            return redirect(route('tipoMedicamentos.index'));
        }

        $tipoMedicamentos = $this->tipoMedicamentosRepository->update($request->all(), $id);

        Flash::success('Tipo Medicamentos Actualizado con exito.');

        return redirect(route('tipoMedicamentos.index'));
    }

    /**
     * Remove the specified tipo_medicamentos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoMedicamentos = $this->tipoMedicamentosRepository->findWithoutFail($id);

        if (empty($tipoMedicamentos)) {
            Flash::error('Tipo Medicamentos not found');

            return redirect(route('tipoMedicamentos.index'));
        }

        $this->tipoMedicamentosRepository->delete($id);

        Flash::success('Tipo Medicamentos Borrado con exito.');

        return redirect(route('tipoMedicamentos.index'));
    }
}
