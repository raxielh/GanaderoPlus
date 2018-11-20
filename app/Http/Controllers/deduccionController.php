<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatededuccionRequest;
use App\Http\Requests\UpdatededuccionRequest;
use App\Repositories\deduccionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use Session;
use Response;

class deduccionController extends AppBaseController
{
    /** @var  deduccionRepository */
    private $deduccionRepository;

    public function __construct(deduccionRepository $deduccionRepo)
    {
        $this->deduccionRepository = $deduccionRepo;
    }

    /**
     * Display a listing of the deduccion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->deduccionRepository->pushCriteria(new RequestCriteria($request));
        $deduccions = $this->deduccionRepository->all();

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('deduccions.index')
            ->with('deduccions', $deduccions)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new deduccion.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('deduccions.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created deduccion in storage.
     *
     * @param CreatededuccionRequest $request
     *
     * @return Response
     */
    public function store(CreatededuccionRequest $request)
    {
        $input = $request->all();

        $deduccion = $this->deduccionRepository->create($input);

        Flash::success('Deduccion Guardado exitosamente.');

        return redirect(route('deduccions.index'));
    }

    /**
     * Display the specified deduccion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deduccion = $this->deduccionRepository->findWithoutFail($id);

        if (empty($deduccion)) {
            Flash::error('Deduccion not found');

            return redirect(route('deduccions.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('deduccions.show')->with('deduccion', $deduccion)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified deduccion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deduccion = $this->deduccionRepository->findWithoutFail($id);

        if (empty($deduccion)) {
            Flash::error('Deduccion not found');

            return redirect(route('deduccions.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('deduccions.edit')->with('deduccion', $deduccion)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified deduccion in storage.
     *
     * @param  int              $id
     * @param UpdatededuccionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatededuccionRequest $request)
    {
        $deduccion = $this->deduccionRepository->findWithoutFail($id);

        if (empty($deduccion)) {
            Flash::error('Deduccion not found');

            return redirect(route('deduccions.index'));
        }

        $deduccion = $this->deduccionRepository->update($request->all(), $id);

        Flash::success('Deduccion Actualizado con exito.');

        return redirect(route('deduccions.index'));
    }

    /**
     * Remove the specified deduccion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deduccion = $this->deduccionRepository->findWithoutFail($id);

        if (empty($deduccion)) {
            Flash::error('Deduccion not found');

            return redirect(route('deduccions.index'));
        }

        $this->deduccionRepository->delete($id);

        Flash::success('Deduccion Borrado con exito.');

        return redirect(route('deduccions.index'));
    }
}
