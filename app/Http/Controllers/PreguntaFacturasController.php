<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePreguntaFacturasRequest;
use App\Http\Requests\UpdatePreguntaFacturasRequest;
use App\Repositories\PreguntaFacturasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use Session;
use Response;

class PreguntaFacturasController extends AppBaseController
{
    /** @var  PreguntaFacturasRepository */
    private $preguntaFacturasRepository;

    public function __construct(PreguntaFacturasRepository $preguntaFacturasRepo)
    {
        $this->preguntaFacturasRepository = $preguntaFacturasRepo;
    }

    /**
     * Display a listing of the PreguntaFacturas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->preguntaFacturasRepository->pushCriteria(new RequestCriteria($request));
        $preguntaFacturas = $this->preguntaFacturasRepository->all();

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('pregunta_facturas.index')
            ->with('preguntaFacturas', $preguntaFacturas)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new PreguntaFacturas.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('pregunta_facturas.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created PreguntaFacturas in storage.
     *
     * @param CreatePreguntaFacturasRequest $request
     *
     * @return Response
     */
    public function store(CreatePreguntaFacturasRequest $request)
    {
        $input = $request->all();

        $preguntaFacturas = $this->preguntaFacturasRepository->create($input);

        Flash::success('Pregunta Facturas Guardado exitosamente.');

        return redirect(route('preguntaFacturas.index'));
    }

    /**
     * Display the specified PreguntaFacturas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $preguntaFacturas = $this->preguntaFacturasRepository->findWithoutFail($id);

        if (empty($preguntaFacturas)) {
            Flash::error('Pregunta Facturas not found');

            return redirect(route('preguntaFacturas.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('pregunta_facturas.show')->with('preguntaFacturas', $preguntaFacturas)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified PreguntaFacturas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $preguntaFacturas = $this->preguntaFacturasRepository->findWithoutFail($id);

        if (empty($preguntaFacturas)) {
            Flash::error('Pregunta Facturas not found');

            return redirect(route('preguntaFacturas.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('pregunta_facturas.edit')->with('preguntaFacturas', $preguntaFacturas)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified PreguntaFacturas in storage.
     *
     * @param  int              $id
     * @param UpdatePreguntaFacturasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePreguntaFacturasRequest $request)
    {
        $preguntaFacturas = $this->preguntaFacturasRepository->findWithoutFail($id);

        if (empty($preguntaFacturas)) {
            Flash::error('Pregunta Facturas not found');

            return redirect(route('preguntaFacturas.index'));
        }

        $preguntaFacturas = $this->preguntaFacturasRepository->update($request->all(), $id);

        Flash::success('Pregunta Facturas Actualizado con exito.');

        return redirect(route('preguntaFacturas.index'));
    }

    /**
     * Remove the specified PreguntaFacturas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $preguntaFacturas = $this->preguntaFacturasRepository->findWithoutFail($id);

        if (empty($preguntaFacturas)) {
            Flash::error('Pregunta Facturas not found');

            return redirect(route('preguntaFacturas.index'));
        }

        $this->preguntaFacturasRepository->delete($id);

        Flash::success('Pregunta Facturas Borrado con exito.');

        return redirect(route('preguntaFacturas.index'));
    }
}
