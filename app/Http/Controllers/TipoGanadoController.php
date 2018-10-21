<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoGanadoRequest;
use App\Http\Requests\UpdateTipoGanadoRequest;
use App\Repositories\TipoGanadoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use Session;

class TipoGanadoController extends AppBaseController
{
    /** @var  TipoGanadoRepository */
    private $tipoGanadoRepository;

    public function __construct(TipoGanadoRepository $tipoGanadoRepo)
    {
        $this->tipoGanadoRepository = $tipoGanadoRepo;
    }

    /**
     * Display a listing of the TipoGanado.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        $this->tipoGanadoRepository->pushCriteria(new RequestCriteria($request));
        $tipoGanados = $this->tipoGanadoRepository->all();

        return view('tipo_ganados.index')
            ->with('tipoGanados', $tipoGanados)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new TipoGanado.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('tipo_ganados.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created TipoGanado in storage.
     *
     * @param CreateTipoGanadoRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoGanadoRequest $request)
    {
        $input = $request->all();

        $tipoGanado = $this->tipoGanadoRepository->create($input);

        Flash::success('Tipo Ganado Guardado exitosamente.');

        return redirect(route('tipoGanados.index'));
    }

    /**
     * Display the specified TipoGanado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
               
        $tipoGanado = $this->tipoGanadoRepository->findWithoutFail($id);

        if (empty($tipoGanado)) {
            Flash::error('Tipo Ganado not found');

            return redirect(route('tipoGanados.index'));
        }

        return view('tipo_ganados.show')->with('tipoGanado', $tipoGanado)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified TipoGanado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        $tipoGanado = $this->tipoGanadoRepository->findWithoutFail($id);

        if (empty($tipoGanado)) {
            Flash::error('Tipo Ganado not found');

            return redirect(route('tipoGanados.index'));
        }

        return view('tipo_ganados.edit')->with('tipoGanado', $tipoGanado)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified TipoGanado in storage.
     *
     * @param  int              $id
     * @param UpdateTipoGanadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoGanadoRequest $request)
    {
        $tipoGanado = $this->tipoGanadoRepository->findWithoutFail($id);

        if (empty($tipoGanado)) {
            Flash::error('Tipo Ganado not found');

            return redirect(route('tipoGanados.index'));
        }

        $tipoGanado = $this->tipoGanadoRepository->update($request->all(), $id);

        Flash::success('Tipo Ganado Actualizado con exito.');

        return redirect(route('tipoGanados.index'));
    }

    /**
     * Remove the specified TipoGanado from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoGanado = $this->tipoGanadoRepository->findWithoutFail($id);

        if (empty($tipoGanado)) {
            Flash::error('Tipo Ganado not found');

            return redirect(route('tipoGanados.index'));
        }

        $this->tipoGanadoRepository->delete($id);

        Flash::success('Tipo Ganado Borrado con exito.');

        return redirect(route('tipoGanados.index'));
    }
}
