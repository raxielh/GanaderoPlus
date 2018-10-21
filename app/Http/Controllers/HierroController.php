<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateHierroRequest;
use App\Http\Requests\UpdateHierroRequest;
use App\Repositories\HierroRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Fincas;
use Session;


class HierroController extends AppBaseController
{
    /** @var  HierroRepository */
    private $hierroRepository;

    public function __construct(HierroRepository $hierroRepo)
    {
        $this->hierroRepository = $hierroRepo;
    }

    /**
     * Display a listing of the Hierro.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Session::all();

        $this->hierroRepository->pushCriteria(new RequestCriteria($request));
        $hierros = $this->hierroRepository->all()->where('fincas_id',$data['finca']);

        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('hierros.index')
            ->with('hierros', $hierros)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new Hierro.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('hierros.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created Hierro in storage.
     *
     * @param CreateHierroRequest $request
     *
     * @return Response
     */
    public function store(CreateHierroRequest $request)
    {
        $input = $request->all();

        if($request->file('hierro')){
            $hierro=$request->file('hierro')->store('public');
        }else{
            $hierro='public/default.png';
        }

        $data = Session::all();

        $input['hierro']=$hierro;
        $input['users_id']=Auth::id();

        $input['fincas_id']=$data['finca'];

        $hierro = $this->hierroRepository->create($input);

        Flash::success('Hierro Guardado exitosamente.');

        return redirect(route('hierros.index'));
    }

    /**
     * Display the specified Hierro.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hierro = $this->hierroRepository->findWithoutFail($id);

        if (empty($hierro)) {
            Flash::error('Hierro not found');

            return redirect(route('hierros.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('hierros.show')->with('hierro', $hierro)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified Hierro.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hierro = $this->hierroRepository->findWithoutFail($id);

        if (empty($hierro)) {
            Flash::error('Hierro not found');

            return redirect(route('hierros.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('hierros.edit')->with('hierro', $hierro)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified Hierro in storage.
     *
     * @param  int              $id
     * @param UpdateHierroRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHierroRequest $request)
    {
        $hierro = $this->hierroRepository->findWithoutFail($id);

        if (empty($hierro)) {
            Flash::error('Hierro not found');

            return redirect(route('hierros.index'));
        }
        
        if($request->hierro){
            $hierro=$request->file('hierro')->store('public');
            $input['hierro']=$hierro;
        }

        $input['_method']=$request->_method;
        $input['_token']=$request->_token;

        $hierro = $this->hierroRepository->update($input, $id);

        Flash::success('Hierro Actualizado con exito.');

        return redirect(route('hierros.index'));
    }

    /**
     * Remove the specified Hierro from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hierro = $this->hierroRepository->findWithoutFail($id);

        if (empty($hierro)) {
            Flash::error('Hierro not found');

            return redirect(route('hierros.index'));
        }

        $this->hierroRepository->delete($id);

        Flash::success('Hierro Borrado con exito.');

        return redirect(route('hierros.index'));
    }
}
