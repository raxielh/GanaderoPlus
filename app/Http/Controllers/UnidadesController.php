<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUnidadesRequest;
use App\Http\Requests\UpdateUnidadesRequest;
use App\Repositories\UnidadesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use Session;
use Response;

class UnidadesController extends AppBaseController
{
    /** @var  UnidadesRepository */
    private $unidadesRepository;

    public function __construct(UnidadesRepository $unidadesRepo)
    {
        $this->unidadesRepository = $unidadesRepo;
    }

    /**
     * Display a listing of the Unidades.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->unidadesRepository->pushCriteria(new RequestCriteria($request));
        $unidades = $this->unidadesRepository->all();

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('unidades.index')
            ->with('unidades', $unidades)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new Unidades.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('unidades.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created Unidades in storage.
     *
     * @param CreateUnidadesRequest $request
     *
     * @return Response
     */
    public function store(CreateUnidadesRequest $request)
    {
        $input = $request->all();

        $unidades = $this->unidadesRepository->create($input);

        Flash::success('Unidades Guardado exitosamente.');

        return redirect(route('unidades.index'));
    }

    /**
     * Display the specified Unidades.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $unidades = $this->unidadesRepository->findWithoutFail($id);

        if (empty($unidades)) {
            Flash::error('Unidades not found');

            return redirect(route('unidades.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('unidades.show')->with('unidades', $unidades)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified Unidades.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $unidades = $this->unidadesRepository->findWithoutFail($id);

        if (empty($unidades)) {
            Flash::error('Unidades not found');

            return redirect(route('unidades.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('unidades.edit')->with('unidades', $unidades)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified Unidades in storage.
     *
     * @param  int              $id
     * @param UpdateUnidadesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUnidadesRequest $request)
    {
        $unidades = $this->unidadesRepository->findWithoutFail($id);

        if (empty($unidades)) {
            Flash::error('Unidades not found');

            return redirect(route('unidades.index'));
        }

        $unidades = $this->unidadesRepository->update($request->all(), $id);

        Flash::success('Unidades Actualizado con exito.');

        return redirect(route('unidades.index'));
    }

    /**
     * Remove the specified Unidades from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $unidades = $this->unidadesRepository->findWithoutFail($id);

        if (empty($unidades)) {
            Flash::error('Unidades not found');

            return redirect(route('unidades.index'));
        }

        $this->unidadesRepository->delete($id);

        Flash::success('Unidades Borrado con exito.');

        return redirect(route('unidades.index'));
    }
}
