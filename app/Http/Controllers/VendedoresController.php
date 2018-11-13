<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateVendedoresRequest;
use App\Http\Requests\UpdateVendedoresRequest;
use App\Repositories\VendedoresRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Fincas;
use Session;


class VendedoresController extends AppBaseController
{
    /** @var  VendedoresRepository */
    private $vendedoresRepository;

    public function __construct(VendedoresRepository $vendedoresRepo)
    {
        $this->vendedoresRepository = $vendedoresRepo;
    }

    /**
     * Display a listing of the Vendedores.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Session::all();

        $this->vendedoresRepository->pushCriteria(new RequestCriteria($request));
        $vendedores = $this->vendedoresRepository->all()->where('fincas_id',$data['finca']);

        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('vendedores.index')
            ->with('vendedores', $vendedores)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new Vendedores.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('vendedores.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created Vendedores in storage.
     *
     * @param CreateVendedoresRequest $request
     *
     * @return Response
     */
    public function store(CreateVendedoresRequest $request)
    {
        $input = $request->all();
        $data = Session::all();
        $input['fincas_id']=$data['finca'];
        $input['users_id']=Auth::id();

        $vendedores = $this->vendedoresRepository->create($input);

        Flash::success('Vendedores Guardado exitosamente.');

        if($request->op==1){
            return Redirect::back()->withInput(Input::all());
        }else{
            return redirect(route('vendedores.index'));
        }

    }

    /**
     * Display the specified Vendedores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vendedores = $this->vendedoresRepository->findWithoutFail($id);

        if (empty($vendedores)) {
            Flash::error('Vendedores not found');

            return redirect(route('vendedores.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('vendedores.show')->with('vendedores', $vendedores)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified Vendedores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vendedores = $this->vendedoresRepository->findWithoutFail($id);

        if (empty($vendedores)) {
            Flash::error('Vendedores not found');

            return redirect(route('vendedores.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('vendedores.edit')->with('vendedores', $vendedores)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified Vendedores in storage.
     *
     * @param  int              $id
     * @param UpdateVendedoresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVendedoresRequest $request)
    {
        $vendedores = $this->vendedoresRepository->findWithoutFail($id);

        if (empty($vendedores)) {
            Flash::error('Vendedores not found');

            return redirect(route('vendedores.index'));
        }

        $vendedores = $this->vendedoresRepository->update($request->all(), $id);

        Flash::success('Vendedores Actualizado con exito.');

        return redirect(route('vendedores.index'));
    }

    /**
     * Remove the specified Vendedores from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vendedores = $this->vendedoresRepository->findWithoutFail($id);

        if (empty($vendedores)) {
            Flash::error('Vendedores not found');

            return redirect(route('vendedores.index'));
        }

        $this->vendedoresRepository->delete($id);

        Flash::success('Vendedores Borrado con exito.');

        return redirect(route('vendedores.index'));
    }
}
