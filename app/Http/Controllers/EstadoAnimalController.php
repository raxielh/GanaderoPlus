<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEstadoAnimalRequest;
use App\Http\Requests\UpdateEstadoAnimalRequest;
use App\Repositories\EstadoAnimalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use Session;
use Response;

class EstadoAnimalController extends AppBaseController
{
    /** @var  EstadoAnimalRepository */
    private $estadoAnimalRepository;

    public function __construct(EstadoAnimalRepository $estadoAnimalRepo)
    {
        $this->estadoAnimalRepository = $estadoAnimalRepo;
    }

    /**
     * Display a listing of the EstadoAnimal.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->estadoAnimalRepository->pushCriteria(new RequestCriteria($request));
        $estadoAnimals = $this->estadoAnimalRepository->all();

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('estado_animals.index')
            ->with('estadoAnimals', $estadoAnimals)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new EstadoAnimal.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('estado_animals.create')->with('Fincas', $Fincas);
    }

    /**
     * Store a newly created EstadoAnimal in storage.
     *
     * @param CreateEstadoAnimalRequest $request
     *
     * @return Response
     */
    public function store(CreateEstadoAnimalRequest $request)
    {
        $input = $request->all();

        $estadoAnimal = $this->estadoAnimalRepository->create($input);

        Flash::success('Estado Animal Guardado exitosamente.');

        return redirect(route('estadoAnimals.index'));
    }

    /**
     * Display the specified EstadoAnimal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estadoAnimal = $this->estadoAnimalRepository->findWithoutFail($id);

        if (empty($estadoAnimal)) {
            Flash::error('Estado Animal not found');

            return redirect(route('estadoAnimals.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('estado_animals.show')->with('estadoAnimal', $estadoAnimal)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified EstadoAnimal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $estadoAnimal = $this->estadoAnimalRepository->findWithoutFail($id);

        if (empty($estadoAnimal)) {
            Flash::error('Estado Animal not found');

            return redirect(route('estadoAnimals.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('estado_animals.edit')->with('estadoAnimal', $estadoAnimal)->with('Fincas', $Fincas);
    }

    /**
     * Update the specified EstadoAnimal in storage.
     *
     * @param  int              $id
     * @param UpdateEstadoAnimalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstadoAnimalRequest $request)
    {
        $estadoAnimal = $this->estadoAnimalRepository->findWithoutFail($id);

        if (empty($estadoAnimal)) {
            Flash::error('Estado Animal not found');

            return redirect(route('estadoAnimals.index'));
        }

        $estadoAnimal = $this->estadoAnimalRepository->update($request->all(), $id);

        Flash::success('Estado Animal Actualizado con exito.');

        return redirect(route('estadoAnimals.index'));
    }

    /**
     * Remove the specified EstadoAnimal from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estadoAnimal = $this->estadoAnimalRepository->findWithoutFail($id);

        if (empty($estadoAnimal)) {
            Flash::error('Estado Animal not found');

            return redirect(route('estadoAnimals.index'));
        }

        $this->estadoAnimalRepository->delete($id);

        Flash::success('Estado Animal Borrado con exito.');

        return redirect(route('estadoAnimals.index'));
    }
}
