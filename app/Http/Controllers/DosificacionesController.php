<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDosificacionesRequest;
use App\Http\Requests\UpdateDosificacionesRequest;
use App\Repositories\DosificacionesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use Session;
use Response;

class DosificacionesController extends AppBaseController
{
    /** @var  DosificacionesRepository */
    private $dosificacionesRepository;

    public function __construct(DosificacionesRepository $dosificacionesRepo)
    {
        $this->dosificacionesRepository = $dosificacionesRepo;
    }

    /**
     * Display a listing of the Dosificaciones.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->dosificacionesRepository->pushCriteria(new RequestCriteria($request));
        $dosificaciones = $this->dosificacionesRepository->all();

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('dosificaciones.index')
            ->with('dosificaciones', $dosificaciones)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new Dosificaciones.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('dosificaciones.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created Dosificaciones in storage.
     *
     * @param CreateDosificacionesRequest $request
     *
     * @return Response
     */
    public function store(CreateDosificacionesRequest $request)
    {
        $input = $request->all();
        
        $data = Session::all();
        $input['users_id']=Auth::id();
        $input['fincas_id']=$data['finca'];
        
        $dosificaciones = $this->dosificacionesRepository->create($input);

        Flash::success('Dosificaciones Guardado exitosamente.');

        //return redirect(route('dosificaciones.index'));
        return back()->withInput();
    }

    /**
     * Display the specified Dosificaciones.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dosificaciones = $this->dosificacionesRepository->findWithoutFail($id);

        if (empty($dosificaciones)) {
            Flash::error('Dosificaciones not found');

            return redirect(route('dosificaciones.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('dosificaciones.show')->with('dosificaciones', $dosificaciones)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified Dosificaciones.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $dosificaciones = $this->dosificacionesRepository->findWithoutFail($id);

        if (empty($dosificaciones)) {
            Flash::error('Dosificaciones not found');

            return redirect(route('dosificaciones.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('dosificaciones.edit')->with('dosificaciones', $dosificaciones)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified Dosificaciones in storage.
     *
     * @param  int              $id
     * @param UpdateDosificacionesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDosificacionesRequest $request)
    {
        $dosificaciones = $this->dosificacionesRepository->findWithoutFail($id);

        if (empty($dosificaciones)) {
            Flash::error('Dosificaciones not found');

            return redirect(route('dosificaciones.index'));
        }

        $dosificaciones = $this->dosificacionesRepository->update($request->all(), $id);

        Flash::success('Dosificaciones Actualizado con exito.');

        return redirect(route('dosificaciones.index'));
    }

    /**
     * Remove the specified Dosificaciones from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dosificaciones = $this->dosificacionesRepository->findWithoutFail($id);

        if (empty($dosificaciones)) {
            Flash::error('Dosificaciones not found');

            return redirect(route('dosificaciones.index'));
        }

        $this->dosificacionesRepository->delete($id);

        Flash::success('Dosificaciones Borrado con exito.');

        //return redirect(route('dosificaciones.index'));
        return back()->withInput();
    }
}
