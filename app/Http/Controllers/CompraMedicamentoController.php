<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompraMedicamentoRequest;
use App\Http\Requests\UpdateCompraMedicamentoRequest;
use App\Repositories\CompraMedicamentoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use App\Models\Medicamentos;
use Session;
use Response;
use Illuminate\Support\Facades\DB;

class CompraMedicamentoController extends AppBaseController
{
    /** @var  CompraMedicamentoRepository */
    private $compraMedicamentoRepository;

    public function __construct(CompraMedicamentoRepository $compraMedicamentoRepo)
    {
        $this->compraMedicamentoRepository = $compraMedicamentoRepo;
    }

    /**
     * Display a listing of the CompraMedicamento.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->compraMedicamentoRepository->pushCriteria(new RequestCriteria($request));
        
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
            
        //$compraMedicamentos = $this->compraMedicamentoRepository->all()->where('fincas_id',$data['finca']);
        
        $compraMedicamentos = DB::table('compra_medicamentos')
                    ->join('medicamentos', 'compra_medicamentos.medicamento_id', '=', 'medicamentos.id')
                    ->where('compra_medicamentos.fincas_id',$data['finca'])
                    ->select('compra_medicamentos.*','medicamentos.descripcion as medicamentos')
                    //->select('potreros.*', 'estado_protreros.descripcion')
                    ->get();

        return view('compra_medicamentos.index')
            ->with('compraMedicamentos', $compraMedicamentos)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new CompraMedicamento.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        $medicamentos=Medicamentos::all()->where('fincas_id',$data['finca'])->pluck('descripcion','id');
        return view('compra_medicamentos.create')->with('Fincas', $Fincas)->with('medicamentos', $medicamentos);
    }

    /**
     * Store a newly created CompraMedicamento in storage.
     *
     * @param CreateCompraMedicamentoRequest $request
     *
     * @return Response
     */
    public function store(CreateCompraMedicamentoRequest $request)
    {
        $input = $request->all();
        
        $data = Session::all();

        $input['users_id']=Auth::id();

        $input['fincas_id']=$data['finca'];

        $compraMedicamento = $this->compraMedicamentoRepository->create($input);

        Flash::success('Compra Medicamento Guardado exitosamente.');

        return redirect(route('compraMedicamentos.index'));
    }

    /**
     * Display the specified CompraMedicamento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $compraMedicamento = $this->compraMedicamentoRepository->findWithoutFail($id);

        if (empty($compraMedicamento)) {
            Flash::error('Compra Medicamento not found');

            return redirect(route('compraMedicamentos.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('compra_medicamentos.show')->with('compraMedicamento', $compraMedicamento)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified CompraMedicamento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $compraMedicamento = $this->compraMedicamentoRepository->findWithoutFail($id);

        if (empty($compraMedicamento)) {
            Flash::error('Compra Medicamento not found');

            return redirect(route('compraMedicamentos.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        $medicamentos=Medicamentos::all()->where('fincas_id',$data['finca'])->pluck('descripcion','id');

        return view('compra_medicamentos.edit')->with('compraMedicamento', $compraMedicamento)->with('Fincas', $Fincas)->with('medicamentos',$medicamentos);
    }

    /**
     * Update the specified CompraMedicamento in storage.
     *
     * @param  int              $id
     * @param UpdateCompraMedicamentoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompraMedicamentoRequest $request)
    {
        $compraMedicamento = $this->compraMedicamentoRepository->findWithoutFail($id);

        if (empty($compraMedicamento)) {
            Flash::error('Compra Medicamento not found');

            return redirect(route('compraMedicamentos.index'));
        }

        $compraMedicamento = $this->compraMedicamentoRepository->update($request->all(), $id);

        Flash::success('Compra Medicamento Actualizado con exito.');

        return redirect(route('compraMedicamentos.index'));
    }

    /**
     * Remove the specified CompraMedicamento from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $compraMedicamento = $this->compraMedicamentoRepository->findWithoutFail($id);

        if (empty($compraMedicamento)) {
            Flash::error('Compra Medicamento not found');

            return redirect(route('compraMedicamentos.index'));
        }

        $this->compraMedicamentoRepository->delete($id);

        Flash::success('Compra Medicamento Borrado con exito.');

        return redirect(route('compraMedicamentos.index'));
    }
}
