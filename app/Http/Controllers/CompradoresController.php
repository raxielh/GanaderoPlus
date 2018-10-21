<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateCompradoresRequest;
use App\Http\Requests\UpdateCompradoresRequest;
use App\Repositories\CompradoresRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Fincas;
use Session;


class CompradoresController extends AppBaseController
{
    /** @var  CompradoresRepository */
    private $compradoresRepository;

    public function __construct(CompradoresRepository $compradoresRepo)
    {
        $this->compradoresRepository = $compradoresRepo;
    }

    /**
     * Display a listing of the Compradores.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Session::all();
        $this->compradoresRepository->pushCriteria(new RequestCriteria($request));
        $compradores = $this->compradoresRepository->all()->where('fincas_id',$data['finca']);

        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('compradores.index')
            ->with('compradores', $compradores)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new Compradores.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('compradores.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created Compradores in storage.
     *
     * @param CreateCompradoresRequest $request
     *
     * @return Response
     */
    public function store(CreateCompradoresRequest $request)
    {
        $input = $request->all();

        $data = Session::all();
        $input['fincas_id']=$data['finca'];
        $input['users_id']=Auth::id();

        $compradores = $this->compradoresRepository->create($input);

        Flash::success('Compradores Guardado exitosamente.');

        return redirect(route('compradores.index'));
    }

    /**
     * Display the specified Compradores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $compradores = $this->compradoresRepository->findWithoutFail($id);

        if (empty($compradores)) {
            Flash::error('Compradores not found');

            return redirect(route('compradores.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('compradores.show')->with('compradores', $compradores)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified Compradores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $compradores = $this->compradoresRepository->findWithoutFail($id);

        if (empty($compradores)) {
            Flash::error('Compradores not found');

            return redirect(route('compradores.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('compradores.edit')->with('compradores', $compradores)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified Compradores in storage.
     *
     * @param  int              $id
     * @param UpdateCompradoresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompradoresRequest $request)
    {
        $compradores = $this->compradoresRepository->findWithoutFail($id);

        if (empty($compradores)) {
            Flash::error('Compradores not found');

            return redirect(route('compradores.index'));
        }

        $compradores = $this->compradoresRepository->update($request->all(), $id);

        Flash::success('Compradores Actualizado con exito.');

        return redirect(route('compradores.index'));
    }

    /**
     * Remove the specified Compradores from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $compradores = $this->compradoresRepository->findWithoutFail($id);

        if (empty($compradores)) {
            Flash::error('Compradores not found');

            return redirect(route('compradores.index'));
        }

        $this->compradoresRepository->delete($id);

        Flash::success('Compradores Borrado con exito.');

        return redirect(route('compradores.index'));
    }
}
