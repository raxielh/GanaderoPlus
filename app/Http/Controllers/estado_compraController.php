<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Createestado_compraRequest;
use App\Http\Requests\Updateestado_compraRequest;
use App\Repositories\estado_compraRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Fincas;
use Session;


class estado_compraController extends AppBaseController
{
    /** @var  estado_compraRepository */
    private $estadoCompraRepository;

    public function __construct(estado_compraRepository $estadoCompraRepo)
    {
        $this->estadoCompraRepository = $estadoCompraRepo;
    }

    /**
     * Display a listing of the estado_compra.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->estadoCompraRepository->pushCriteria(new RequestCriteria($request));
        $estadoCompras = $this->estadoCompraRepository->all();

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('estado_compras.index')
            ->with('estadoCompras', $estadoCompras)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new estado_compra.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('estado_compras.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created estado_compra in storage.
     *
     * @param Createestado_compraRequest $request
     *
     * @return Response
     */
    public function store(Createestado_compraRequest $request)
    {
        $input = $request->all();

        $estadoCompra = $this->estadoCompraRepository->create($input);

        Flash::success('Estado Compra Guardado exitosamente.');

        return redirect(route('estadoCompras.index'));
    }

    /**
     * Display the specified estado_compra.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estadoCompra = $this->estadoCompraRepository->findWithoutFail($id);

        if (empty($estadoCompra)) {
            Flash::error('Estado Compra not found');

            return redirect(route('estadoCompras.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('estado_compras.show')->with('estadoCompra', $estadoCompra)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified estado_compra.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $estadoCompra = $this->estadoCompraRepository->findWithoutFail($id);

        if (empty($estadoCompra)) {
            Flash::error('Estado Compra not found');

            return redirect(route('estadoCompras.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('estado_compras.edit')->with('estadoCompra', $estadoCompra)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified estado_compra in storage.
     *
     * @param  int              $id
     * @param Updateestado_compraRequest $request
     *
     * @return Response
     */
    public function update($id, Updateestado_compraRequest $request)
    {
        $estadoCompra = $this->estadoCompraRepository->findWithoutFail($id);

        if (empty($estadoCompra)) {
            Flash::error('Estado Compra not found');

            return redirect(route('estadoCompras.index'));
        }

        $estadoCompra = $this->estadoCompraRepository->update($request->all(), $id);

        Flash::success('Estado Compra Actualizado con exito.');

        return redirect(route('estadoCompras.index'));
    }

    /**
     * Remove the specified estado_compra from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estadoCompra = $this->estadoCompraRepository->findWithoutFail($id);

        if (empty($estadoCompra)) {
            Flash::error('Estado Compra not found');

            return redirect(route('estadoCompras.index'));
        }

        $this->estadoCompraRepository->delete($id);

        Flash::success('Estado Compra Borrado con exito.');

        return redirect(route('estadoCompras.index'));
    }
}
