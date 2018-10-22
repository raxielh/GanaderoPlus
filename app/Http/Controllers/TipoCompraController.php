<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoCompraRequest;
use App\Http\Requests\UpdateTipoCompraRequest;
use App\Repositories\TipoCompraRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use Session;

class TipoCompraController extends AppBaseController
{
    /** @var  TipoGanadoRepository */
    private $TipoCompraRepository;

    public function __construct(TipoCompraRepository $tipoGanadoRepo)
    {
        $this->TipoCompraRepository = $tipoGanadoRepo;
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

        $this->TipoCompraRepository->pushCriteria(new RequestCriteria($request));
        $tipoGanados = $this->TipoCompraRepository->all();

        return view('tipo_compra.index')
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
        return view('tipo_compra.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created TipoGanado in storage.
     *
     * @param CreateTipoGanadoRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoCompraRequest $request)
    {
        $input = $request->all();

        //dd($input);

        $tipoGanado = $this->TipoCompraRepository->create($input);

        Flash::success('Tipo Compra Guardado exitosamente.');

        return redirect(route('tipoCompra.index'));
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
               
        $tipoGanado = $this->TipoCompraRepository->findWithoutFail($id);

        if (empty($tipoGanado)) {
            Flash::error('Tipo Compra not found');

            return redirect(route('tipo_compra.index'));
        }

        return view('tipo_compra.show')->with('tipoGanado', $tipoGanado)->with('Fincas', $Fincas);
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

        $tipoGanado = $this->TipoCompraRepository->findWithoutFail($id);

        if (empty($tipoGanado)) {
            Flash::error('Tipo Compra not found');

            return redirect(route('tipo_compra.index'));
        }

        return view('tipo_compra.edit')->with('tipoGanado', $tipoGanado)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified TipoGanado in storage.
     *
     * @param  int              $id
     * @param UpdateTipoGanadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoCompraRequest $request)
    {
        $tipoGanado = $this->TipoCompraRepository->findWithoutFail($id);

        if (empty($tipoGanado)) {
            Flash::error('Tipo Compra not found');

            return redirect(route('tipoCompra.index'));
        }

        $tipoGanado = $this->TipoCompraRepository->update($request->all(), $id);

        Flash::success('Tipo Compra Actualizado con exito.');

        return redirect(route('tipoCompra.index'));
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
        $tipoGanado = $this->TipoCompraRepository->findWithoutFail($id);

        if (empty($tipoGanado)) {
            Flash::error('Tipo Compra not found');

            return redirect(route('tipoCompra.index'));
        }

        $this->TipoCompraRepository->delete($id);

        Flash::success('Tipo Compra Borrado con exito.');

        return redirect(route('tipoCompra.index'));
    }
}
