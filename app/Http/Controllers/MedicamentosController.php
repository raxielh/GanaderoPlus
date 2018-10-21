<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicamentosRequest;
use App\Http\Requests\UpdateMedicamentosRequest;
use App\Repositories\MedicamentosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use App\Models\tipo_medicamentos;
use App\Models\Unidades;
use App\Models\presentacion;
use App\Models\Dosificaciones;
use Session;
use Response;
use Illuminate\Support\Facades\DB;

class MedicamentosController extends AppBaseController
{
    /** @var  MedicamentosRepository */
    private $medicamentosRepository;

    public function __construct(MedicamentosRepository $medicamentosRepo)
    {
        $this->medicamentosRepository = $medicamentosRepo;
    }

    /**
     * Display a listing of the Medicamentos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        
        $this->medicamentosRepository->pushCriteria(new RequestCriteria($request));
        //$medicamentos = $this->medicamentosRepository->all();
        $data = Session::all();
        $medicamentos = DB::select("select m.*,tp.descripcion as tipo_medicamentos,u.descripcion as unidades,p.descripcion as presentacion from medicamentos m,tipo_medicamentos tp,unidades u,presentacions p where m.tipo_medicamentos_id=tp.id and m.unidad_id=u.id AND m.presentacion_id=p.id AND fincas_id=".$data['finca']."");

        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('medicamentos.index')
            ->with('medicamentos', $medicamentos)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new Medicamentos.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        $tipo_medicamentos=tipo_medicamentos::all()->pluck('descripcion','id');
        $Unidades=Unidades::all()->pluck('descripcion','id');
        $presentacion=presentacion::all()->pluck('descripcion','id');
        return view('medicamentos.create')->with('Fincas', $Fincas)->with('tipo_medicamentos', $tipo_medicamentos)->with('Unidades', $Unidades)->with('presentacion', $presentacion);
    }

    /**
     * Store a newly created Medicamentos in storage.
     *
     * @param CreateMedicamentosRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicamentosRequest $request)
    {
        $input = $request->all();
        
        $data = Session::all();
        $input['users_id']=Auth::id();
        $input['fincas_id']=$data['finca'];

        $medicamentos = $this->medicamentosRepository->create($input);

        Flash::success('Medicamentos Guardado exitosamente.');

        return redirect(route('medicamentos.index'));
    }

    /**
     * Display the specified Medicamentos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data = Session::all();
        //$medicamentos = $this->medicamentosRepository->findWithoutFail($id);
        $medicamentos = DB::select("select m.*,tp.descripcion as tipo_medicamentos,u.descripcion as unidades,p.descripcion as presentacion from medicamentos m,tipo_medicamentos tp,unidades u,presentacions p where m.tipo_medicamentos_id=tp.id and m.unidad_id=u.id AND m.presentacion_id=p.id AND m.fincas_id=".$data['finca']." AND m.id=".$id."");

        if (empty($medicamentos)) {
            Flash::error('Medicamentos not found');

            return redirect(route('medicamentos.index'));
        }

        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        
        $dosificaciones = Dosificaciones::where('fincas_id',$data['finca'])->where('medicamento_id',$id)->orderBy('dosis', 'ASC')->get();

        return view('medicamentos.show')->with('medicamentos', $medicamentos)->with('Fincas', $Fincas)->with('dosificaciones', $dosificaciones);
    }

    /**
     * Show the form for editing the specified Medicamentos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medicamentos = $this->medicamentosRepository->findWithoutFail($id);

        if (empty($medicamentos)) {
            Flash::error('Medicamentos not found');

            return redirect(route('medicamentos.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        $tipo_medicamentos=tipo_medicamentos::all()->pluck('descripcion','id');
        $Unidades=Unidades::all()->pluck('descripcion','id');
        $presentacion=presentacion::all()->pluck('descripcion','id');

        return view('medicamentos.edit')->with('medicamentos', $medicamentos)->with('Fincas', $Fincas)->with('tipo_medicamentos', $tipo_medicamentos)->with('Unidades',$Unidades)->with('presentacion', $presentacion);;
    }

    /**
     * Update the specified Medicamentos in storage.
     *
     * @param  int              $id
     * @param UpdateMedicamentosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicamentosRequest $request)
    {
        $medicamentos = $this->medicamentosRepository->findWithoutFail($id);

        if (empty($medicamentos)) {
            Flash::error('Medicamentos not found');

            return redirect(route('medicamentos.index'));
        }

        $medicamentos = $this->medicamentosRepository->update($request->all(), $id);

        Flash::success('Medicamentos Actualizado con exito.');

        return redirect(route('medicamentos.index'));
    }

    /**
     * Remove the specified Medicamentos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medicamentos = $this->medicamentosRepository->findWithoutFail($id);

        if (empty($medicamentos)) {
            Flash::error('Medicamentos not found');

            return redirect(route('medicamentos.index'));
        }

        $this->medicamentosRepository->delete($id);

        Flash::success('Medicamentos Borrado con exito.');

        return redirect(route('medicamentos.index'));
    }
    
    public function buscar_precio($id)
    {
        $data = Session::all();
        return DB::select("select precio from medicamentos where id=".$id." AND fincas_id=".$data['finca']."");
    }
    
    public function historial($id)
    {
        $data = Session::all();
        $precios = DB::select("select * from compra_medicamentos where fincas_id=".$data['finca']." AND medicamento_id=".$id."");

        if (empty($precios)) {
            Flash::error('Medicamentos not found');

            return redirect(route('medicamentos.index'));
        }

        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('medicamentos.historial')->with('precios', $precios)->with('Fincas', $Fincas);
    }
    
    
    
    
}
