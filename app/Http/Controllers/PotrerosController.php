<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePotrerosRequest;
use App\Http\Requests\UpdatePotrerosRequest;
use App\Repositories\PotrerosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Fincas;
use App\Models\EstadoProtrero;
use Response;
use Flash;
use Session;

class PotrerosController extends AppBaseController
{
    /** @var  PotrerosRepository */
    private $potrerosRepository;

    public function __construct(PotrerosRepository $potrerosRepo)
    {
        $this->potrerosRepository = $potrerosRepo;
    }

    /**
     * Display a listing of the Potreros.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        //$this->potrerosRepository->pushCriteria(new RequestCriteria($request));
        //$potreros = $this->potrerosRepository->all();

        $potreros = DB::table('potreros')
                    ->join('estado_protreros', 'potreros.estado_id', '=', 'estado_protreros.id')
                    ->where('potreros.fincas_id',$data['finca'])
                    ->select('potreros.*', 'estado_protreros.descripcion')
                    ->get();

        return view('potreros.index')
            ->with('potreros', $potreros)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new Potreros.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $EstadoPotrero = EstadoProtrero::all()->pluck('descripcion','id');
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('potreros.create')
                ->with('Fincas', $Fincas)
                ->with('EstadoPotrero', $EstadoPotrero);
    }

    /**
     * Store a newly created Potreros in storage.
     *
     * @param CreatePotrerosRequest $request
     *
     * @return Response
     */
    public function store(CreatePotrerosRequest $request)
    {
        $input = $request->all();
        $data = Session::all();

        $input['users_id']=Auth::id();

        $input['fincas_id']=$data['finca'];

        $potreros = $this->potrerosRepository->create($input);

        Flash::success('Potreros Guardado exitosamente.');

        return redirect(route('potreros.index'));
    }

    /**
     * Display the specified Potreros.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $potreros = $this->potrerosRepository->findWithoutFail($id);

        if (empty($potreros)) {
            Flash::error('Potreros not found');

            return redirect(route('potreros.index'));
        }
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('potreros.show')
                ->with('potreros', $potreros)  
                ->with('Fincas', $Fincas);;
    }

    /**
     * Show the form for editing the specified Potreros.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $potreros = $this->potrerosRepository->findWithoutFail($id);

        if (empty($potreros)) {
            Flash::error('Potreros not found');

            return redirect(route('potreros.index'));
        }

        $EstadoPotrero = EstadoProtrero::all()->pluck('descripcion','id');

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('potreros.edit')
                    ->with('potreros', $potreros)
                    ->with('Fincas', $Fincas)
                    ->with('EstadoPotrero', $EstadoPotrero);
    }

    /**
     * Update the specified Potreros in storage.
     *
     * @param  int              $id
     * @param UpdatePotrerosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePotrerosRequest $request)
    {
        $potreros = $this->potrerosRepository->findWithoutFail($id);

        if (empty($potreros)) {
            Flash::error('Potreros not found');

            return redirect(route('potreros.index'));
        }

        $potreros = $this->potrerosRepository->update($request->all(), $id);

        Flash::success('Potreros Actualizado con exito.');

        return redirect(route('potreros.index'));
    }

    /**
     * Remove the specified Potreros from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $potreros = $this->potrerosRepository->findWithoutFail($id);

        if (empty($potreros)) {
            Flash::error('Potreros not found');

            return redirect(route('potreros.index'));
        }

        $this->potrerosRepository->delete($id);

        Flash::success('Potreros Borrado con exito.');

        return redirect(route('potreros.index'));
    }
}
