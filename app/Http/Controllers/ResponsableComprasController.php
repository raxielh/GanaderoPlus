<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateResponsableComprasRequest;
use App\Http\Requests\UpdateResponsableComprasRequest;
use App\Repositories\ResponsableComprasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Fincas;
use Session;


class ResponsableComprasController extends AppBaseController
{
    /** @var  ResponsableComprasRepository */
    private $responsableComprasRepository;

    public function __construct(ResponsableComprasRepository $responsableComprasRepo)
    {
        $this->responsableComprasRepository = $responsableComprasRepo;
    }

    /**
     * Display a listing of the ResponsableCompras.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Session::all();
        $this->responsableComprasRepository->pushCriteria(new RequestCriteria($request));
        $responsableCompras = $this->responsableComprasRepository->all()->where('fincas_id',$data['finca']);

        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('responsable_compras.index')
            ->with('responsableCompras', $responsableCompras)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new ResponsableCompras.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('responsable_compras.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created ResponsableCompras in storage.
     *
     * @param CreateResponsableComprasRequest $request
     *
     * @return Response
     */
    public function store(CreateResponsableComprasRequest $request)
    {
        $input = $request->all();

        $data = Session::all();
        $input['fincas_id']=$data['finca'];
        $input['users_id']=Auth::id();

        $responsableCompras = $this->responsableComprasRepository->create($input);

        Flash::success('Responsable Compras Guardado exitosamente.');

        return redirect(route('responsableCompras.index'));
    }

    /**
     * Display the specified ResponsableCompras.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $responsableCompras = $this->responsableComprasRepository->findWithoutFail($id);

        if (empty($responsableCompras)) {
            Flash::error('Responsable Compras not found');

            return redirect(route('responsableCompras.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('responsable_compras.show')->with('responsableCompras', $responsableCompras)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified ResponsableCompras.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $responsableCompras = $this->responsableComprasRepository->findWithoutFail($id);

        if (empty($responsableCompras)) {
            Flash::error('Responsable Compras not found');

            return redirect(route('responsableCompras.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('responsable_compras.edit')->with('responsableCompras', $responsableCompras)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified ResponsableCompras in storage.
     *
     * @param  int              $id
     * @param UpdateResponsableComprasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateResponsableComprasRequest $request)
    {
        $responsableCompras = $this->responsableComprasRepository->findWithoutFail($id);

        if (empty($responsableCompras)) {
            Flash::error('Responsable Compras not found');

            return redirect(route('responsableCompras.index'));
        }

        $responsableCompras = $this->responsableComprasRepository->update($request->all(), $id);

        Flash::success('Responsable Compras Actualizado con exito.');

        return redirect(route('responsableCompras.index'));
    }

    /**
     * Remove the specified ResponsableCompras from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $responsableCompras = $this->responsableComprasRepository->findWithoutFail($id);

        if (empty($responsableCompras)) {
            Flash::error('Responsable Compras not found');

            return redirect(route('responsableCompras.index'));
        }

        $this->responsableComprasRepository->delete($id);

        Flash::success('Responsable Compras Borrado con exito.');

        return redirect(route('responsableCompras.index'));
    }
}
