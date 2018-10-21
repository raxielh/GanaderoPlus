<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepresentacionRequest;
use App\Http\Requests\UpdatepresentacionRequest;
use App\Repositories\presentacionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use Session;
use Response;

class presentacionController extends AppBaseController
{
    /** @var  presentacionRepository */
    private $presentacionRepository;

    public function __construct(presentacionRepository $presentacionRepo)
    {
        $this->presentacionRepository = $presentacionRepo;
    }

    /**
     * Display a listing of the presentacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->presentacionRepository->pushCriteria(new RequestCriteria($request));
        $presentacions = $this->presentacionRepository->all();

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('presentacions.index')
            ->with('presentacions', $presentacions)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new presentacion.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('presentacions.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created presentacion in storage.
     *
     * @param CreatepresentacionRequest $request
     *
     * @return Response
     */
    public function store(CreatepresentacionRequest $request)
    {
        $input = $request->all();

        $presentacion = $this->presentacionRepository->create($input);

        Flash::success('Presentacion Guardado exitosamente.');

        return redirect(route('presentacions.index'));
    }

    /**
     * Display the specified presentacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $presentacion = $this->presentacionRepository->findWithoutFail($id);

        if (empty($presentacion)) {
            Flash::error('Presentacion not found');

            return redirect(route('presentacions.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('presentacions.show')->with('presentacion', $presentacion)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified presentacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $presentacion = $this->presentacionRepository->findWithoutFail($id);

        if (empty($presentacion)) {
            Flash::error('Presentacion not found');

            return redirect(route('presentacions.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('presentacions.edit')->with('presentacion', $presentacion)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified presentacion in storage.
     *
     * @param  int              $id
     * @param UpdatepresentacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepresentacionRequest $request)
    {
        $presentacion = $this->presentacionRepository->findWithoutFail($id);

        if (empty($presentacion)) {
            Flash::error('Presentacion not found');

            return redirect(route('presentacions.index'));
        }

        $presentacion = $this->presentacionRepository->update($request->all(), $id);

        Flash::success('Presentacion Actualizado con exito.');

        return redirect(route('presentacions.index'));
    }

    /**
     * Remove the specified presentacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $presentacion = $this->presentacionRepository->findWithoutFail($id);

        if (empty($presentacion)) {
            Flash::error('Presentacion not found');

            return redirect(route('presentacions.index'));
        }

        $this->presentacionRepository->delete($id);

        Flash::success('Presentacion Borrado con exito.');

        return redirect(route('presentacions.index'));
    }
}
