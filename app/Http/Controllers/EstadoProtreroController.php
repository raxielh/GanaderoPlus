<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEstadoProtreroRequest;
use App\Http\Requests\UpdateEstadoProtreroRequest;
use App\Repositories\EstadoProtreroRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Session;
use App\Models\Fincas;

class EstadoProtreroController extends AppBaseController
{
    /** @var  EstadoProtreroRepository */
    private $estadoProtreroRepository;

    public function __construct(EstadoProtreroRepository $estadoProtreroRepo)
    {
        $this->estadoProtreroRepository = $estadoProtreroRepo;
    }

    /**
     * Display a listing of the EstadoProtrero.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        $this->estadoProtreroRepository->pushCriteria(new RequestCriteria($request));
        $estadoProtreros = $this->estadoProtreroRepository->all();

        return view('estado_protreros.index')
            ->with('estadoProtreros', $estadoProtreros)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new EstadoProtrero.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('estado_protreros.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created EstadoProtrero in storage.
     *
     * @param CreateEstadoProtreroRequest $request
     *
     * @return Response
     */
    public function store(CreateEstadoProtreroRequest $request)
    {
        $input = $request->all();

        $estadoProtrero = $this->estadoProtreroRepository->create($input);

        Flash::success('Estado Protrero Guardado exitosamente.');

        return redirect(route('estadoProtreros.index'));
    }

    /**
     * Display the specified EstadoProtrero.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estadoProtrero = $this->estadoProtreroRepository->findWithoutFail($id);

        if (empty($estadoProtrero)) {
            Flash::error('Estado Protrero not found');

            return redirect(route('estadoProtreros.index'));
        }

        return view('estado_protreros.show')->with('estadoProtrero', $estadoProtrero);
    }

    /**
     * Show the form for editing the specified EstadoProtrero.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $estadoProtrero = $this->estadoProtreroRepository->findWithoutFail($id);

        if (empty($estadoProtrero)) {
            Flash::error('Estado Protrero not found');

            return redirect(route('estadoProtreros.index'));
        }

        return view('estado_protreros.edit')->with('estadoProtrero', $estadoProtrero);
    }

    /**
     * Update the specified EstadoProtrero in storage.
     *
     * @param  int              $id
     * @param UpdateEstadoProtreroRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstadoProtreroRequest $request)
    {
        $estadoProtrero = $this->estadoProtreroRepository->findWithoutFail($id);

        if (empty($estadoProtrero)) {
            Flash::error('Estado Protrero not found');

            return redirect(route('estadoProtreros.index'));
        }

        $estadoProtrero = $this->estadoProtreroRepository->update($request->all(), $id);

        Flash::success('Estado Protrero Actualizado con exito.');

        return redirect(route('estadoProtreros.index'));
    }

    /**
     * Remove the specified EstadoProtrero from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estadoProtrero = $this->estadoProtreroRepository->findWithoutFail($id);

        if (empty($estadoProtrero)) {
            Flash::error('Estado Protrero not found');

            return redirect(route('estadoProtreros.index'));
        }

        $this->estadoProtreroRepository->delete($id);

        Flash::success('Estado Protrero Borrado con exito.');

        return redirect(route('estadoProtreros.index'));
    }
}
