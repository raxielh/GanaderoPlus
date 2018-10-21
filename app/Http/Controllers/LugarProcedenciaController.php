<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateLugarProcedenciaRequest;
use App\Http\Requests\UpdateLugarProcedenciaRequest;
use App\Repositories\LugarProcedenciaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Fincas;
use Session;


class LugarProcedenciaController extends AppBaseController
{
    /** @var  LugarProcedenciaRepository */
    private $lugarProcedenciaRepository;

    public function __construct(LugarProcedenciaRepository $lugarProcedenciaRepo)
    {
        $this->lugarProcedenciaRepository = $lugarProcedenciaRepo;
    }

    /**
     * Display a listing of the LugarProcedencia.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Session::all();
        
        $this->lugarProcedenciaRepository->pushCriteria(new RequestCriteria($request));
        $lugarProcedencias = $this->lugarProcedenciaRepository->all()->where('fincas_id',$data['finca']);

        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('lugar_procedencias.index')
            ->with('lugarProcedencias', $lugarProcedencias)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new LugarProcedencia.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('lugar_procedencias.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created LugarProcedencia in storage.
     *
     * @param CreateLugarProcedenciaRequest $request
     *
     * @return Response
     */
    public function store(CreateLugarProcedenciaRequest $request)
    {
        $input = $request->all();
        $data = Session::all();

        $input['users_id']=Auth::id();

        $input['fincas_id']=$data['finca'];

        $lugarProcedencia = $this->lugarProcedenciaRepository->create($input);

        Flash::success('Lugar Procedencia Guardado exitosamente.');

        return redirect(route('lugarProcedencias.index'));
    }

    /**
     * Display the specified LugarProcedencia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lugarProcedencia = $this->lugarProcedenciaRepository->findWithoutFail($id);

        if (empty($lugarProcedencia)) {
            Flash::error('Lugar Procedencia not found');

            return redirect(route('lugarProcedencias.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('lugar_procedencias.show')->with('lugarProcedencia', $lugarProcedencia)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified LugarProcedencia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $lugarProcedencia = $this->lugarProcedenciaRepository->findWithoutFail($id);

        if (empty($lugarProcedencia)) {
            Flash::error('Lugar Procedencia not found');

            return redirect(route('lugarProcedencias.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('lugar_procedencias.edit')->with('lugarProcedencia', $lugarProcedencia)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified LugarProcedencia in storage.
     *
     * @param  int              $id
     * @param UpdateLugarProcedenciaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLugarProcedenciaRequest $request)
    {
        $lugarProcedencia = $this->lugarProcedenciaRepository->findWithoutFail($id);

        if (empty($lugarProcedencia)) {
            Flash::error('Lugar Procedencia not found');

            return redirect(route('lugarProcedencias.index'));
        }

        $lugarProcedencia = $this->lugarProcedenciaRepository->update($request->all(), $id);

        Flash::success('Lugar Procedencia Actualizado con exito.');

        return redirect(route('lugarProcedencias.index'));
    }

    /**
     * Remove the specified LugarProcedencia from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $lugarProcedencia = $this->lugarProcedenciaRepository->findWithoutFail($id);

        if (empty($lugarProcedencia)) {
            Flash::error('Lugar Procedencia not found');

            return redirect(route('lugarProcedencias.index'));
        }

        $this->lugarProcedenciaRepository->delete($id);

        Flash::success('Lugar Procedencia Borrado con exito.');

        return redirect(route('lugarProcedencias.index'));
    }
}
