<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Repositories\EmpresaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use Session;
use Response;

class EmpresaController extends AppBaseController
{
    /** @var  EmpresaRepository */
    private $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepo)
    {
        $this->empresaRepository = $empresaRepo;
    }

    /**
     * Display a listing of the Empresa.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Session::all();
        $this->empresaRepository->pushCriteria(new RequestCriteria($request));
        $empresas = $this->empresaRepository->all()->where('fincas_id',$data['finca']);

        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('empresas.index')
            ->with('empresas', $empresas)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new Empresa.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('empresas.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created Empresa in storage.
     *
     * @param CreateEmpresaRequest $request
     *
     * @return Response
     */
    public function store(CreateEmpresaRequest $request)
    {
        $input = $request->all();

        if($request->file('logo')){
            $logo=$request->file('logo')->store('public');
        }else{
            $logo='public/default_empresa.png';
        }
        $input['logo']=$logo;

        $data = Session::all();
        $input['users_id']=Auth::id();
        $input['fincas_id']=$data['finca'];

        //dd($input);

        $empresa = $this->empresaRepository->create($input);

        Flash::success('Empresa Guardado exitosamente.');

        return redirect(route('empresas.index'));
    }

    /**
     * Display the specified Empresa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $empresa = $this->empresaRepository->findWithoutFail($id);

        if (empty($empresa)) {
            Flash::error('Empresa not found');

            return redirect(route('empresas.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('empresas.show')->with('empresa', $empresa)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified Empresa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $empresa = $this->empresaRepository->findWithoutFail($id);

        if (empty($empresa)) {
            Flash::error('Empresa not found');

            return redirect(route('empresas.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('empresas.edit')->with('empresa', $empresa)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified Empresa in storage.
     *
     * @param  int              $id
     * @param UpdateEmpresaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmpresaRequest $request)
    {
        $empresa = $this->empresaRepository->findWithoutFail($id);

        if (empty($empresa)) {
            Flash::error('Empresa not found');

            return redirect(route('empresas.index'));
        }

        if($request->logo){
            $logo=$request->file('logo')->store('public');
            $input['logo']=$logo;
        }

        $input['_method']=$request->_method;
        $input['_token']=$request->_token;
        $input['nit']=$request->nit;
        $input['razon_social']=$request->razon_social;
        $input['direccion']=$request->direccion;
        $input['telefono']=$request->telefono;


        $empresa = $this->empresaRepository->update($input, $id);

        Flash::success('Empresa Actualizado con exito.');

        return redirect(route('empresas.index'));
    }

    /**
     * Remove the specified Empresa from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $empresa = $this->empresaRepository->findWithoutFail($id);

        if (empty($empresa)) {
            Flash::error('Empresa not found');

            return redirect(route('empresas.index'));
        }

        $this->empresaRepository->delete($id);

        Flash::success('Empresa Borrado con exito.');

        return redirect(route('empresas.index'));
    }
}
