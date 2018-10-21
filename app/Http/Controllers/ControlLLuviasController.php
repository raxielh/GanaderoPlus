<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateControlLLuviasRequest;
use App\Http\Requests\UpdateControlLLuviasRequest;
use App\Repositories\ControlLLuviasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use Session;
use Response;
use Illuminate\Support\Facades\DB;

class ControlLLuviasController extends AppBaseController
{
    /** @var  ControlLLuviasRepository */
    private $controlLLuviasRepository;

    public function __construct(ControlLLuviasRepository $controlLLuviasRepo)
    {
        $this->controlLLuviasRepository = $controlLLuviasRepo;
    }

    /**
     * Display a listing of the ControlLLuvias.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        
        $data = Session::all();
        
        $this->controlLLuviasRepository->pushCriteria(new RequestCriteria($request));
        //$controlLLuvias = $this->controlLLuviasRepository->all()->where('fincas_id',$data['finca'])->orderBy('id', 'desc');
        $controlLLuvias = DB::select("select * from control_l_luvias where fincas_id=".$data['finca']." order by dia desc");
        
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('control_l_luvias.index')
            ->with('controlLLuvias', $controlLLuvias)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new ControlLLuvias.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('control_l_luvias.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created ControlLLuvias in storage.
     *
     * @param CreateControlLLuviasRequest $request
     *
     * @return Response
     */
    public function store(CreateControlLLuviasRequest $request)
    {
        $input = $request->all();
        
        $data = Session::all();
        $input['users_id']=Auth::id();
        $input['fincas_id']=$data['finca'];

        $controlLLuvias = $this->controlLLuviasRepository->create($input);

        Flash::success('Control LLuvias Guardado exitosamente.');

        return redirect(route('controlLLuvias.index'));
    }

    /**
     * Display the specified ControlLLuvias.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $controlLLuvias = $this->controlLLuviasRepository->findWithoutFail($id);

        if (empty($controlLLuvias)) {
            Flash::error('Control L Luvias not found');

            return redirect(route('controlLLuvias.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('control_l_luvias.show')->with('controlLLuvias', $controlLLuvias)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified ControlLLuvias.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $controlLLuvias = $this->controlLLuviasRepository->findWithoutFail($id);

        if (empty($controlLLuvias)) {
            Flash::error('Control L Luvias not found');

            return redirect(route('controlLLuvias.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('control_l_luvias.edit')->with('controlLLuvias', $controlLLuvias)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified ControlLLuvias in storage.
     *
     * @param  int              $id
     * @param UpdateControlLLuviasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateControlLLuviasRequest $request)
    {
        $controlLLuvias = $this->controlLLuviasRepository->findWithoutFail($id);

        if (empty($controlLLuvias)) {
            Flash::error('Control L Luvias not found');

            return redirect(route('controlLLuvias.index'));
        }

        $controlLLuvias = $this->controlLLuviasRepository->update($request->all(), $id);

        Flash::success('Control LLuvias Actualizado con exito.');

        return redirect(route('controlLLuvias.index'));
    }

    /**
     * Remove the specified ControlLLuvias from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $controlLLuvias = $this->controlLLuviasRepository->findWithoutFail($id);

        if (empty($controlLLuvias)) {
            Flash::error('Control L Luvias not found');

            return redirect(route('controlLLuvias.index'));
        }

        $this->controlLLuviasRepository->delete($id);

        Flash::success('Control LLuvias Borrado con exito.');

        return redirect(route('controlLLuvias.index'));
    }
    
    public function resumen()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        $resumen = DB::select("select to_char(dia,'MM'),SUM(cantidad) as cantidad from control_l_luvias where to_char(dia,'yyyy')='".date('Y')."' and fincas_id=".$data['finca']." group by to_char,cantidad order by to_char asc");
        $resumen_table = DB::select("SELECT To_char(dia, 'MM')   AS mes, 
                                            To_char(dia, 'yyyy') AS ano, 
                                            Sum(cantidad)        AS cantidad 
                                    FROM   control_l_luvias 
                                    where to_char(dia,'yyyy')='".date('Y')."' and fincas_id=".$data['finca']."
                                    GROUP  BY To_char(dia, 'MM'), to_char(dia, 'yyyy'),cantidad 
                                    ORDER BY to_char(dia, 'yyyy') DESC,To_char(dia, 'MM') ASC");
        return view('control_l_luvias.resumen')->with('Fincas', $Fincas)->with('resumen', $resumen)->with('resumen_table', $resumen_table);
    }
    
}
