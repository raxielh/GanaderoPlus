<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIngresoAnimalRequest;
use App\Http\Requests\UpdateIngresoAnimalRequest;
use App\Repositories\IngresoAnimalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Models\Fincas;
use App\Models\RegistroCompra;
use App\Models\Potreros;
use App\Models\IngresoLote;
use App\Models\IngresoLoteAnimal;
use Session;
use Response;
use Illuminate\Support\Facades\DB;

class IngresoAnimalController extends AppBaseController
{
    /** @var  IngresoAnimalRepository */
    private $ingresoAnimalRepository;

    public function __construct(IngresoAnimalRepository $ingresoAnimalRepo)
    {
        $this->ingresoAnimalRepository = $ingresoAnimalRepo;
    }

    /**
     * Display a listing of the IngresoAnimal.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->ingresoAnimalRepository->pushCriteria(new RequestCriteria($request));
        $ingresoAnimals = $this->ingresoAnimalRepository->all();

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        $ingresoAnimals = DB::table('ingreso_animals')
                    ->join('registro_compras', 'ingreso_animals.registro_compra_id', '=', 'registro_compras.id')
                    ->where('ingreso_animals.fincas_id',$data['finca'])
                    ->select('ingreso_animals.*','registro_compras.numero_compra')
                    //->select('potreros.*', 'estado_protreros.descripcion')
                    ->get();

        return view('ingreso_animals.index')
            ->with('ingresoAnimals', $ingresoAnimals)
            ->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new IngresoAnimal.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        //$compra = RegistroCompra::all()->where('fincas_id',$data['finca'])->pluck('fecha_compra','id');
        $compra =DB::table('registro_compras')
            ->select(DB::raw("CONCAT (numero_compra,' | ',fecha_compra)AS des"), 'id')
            ->pluck('des','id');
        #dd($compra);
        $potreros = Potreros::all()->where('fincas_id',$data['finca'])->pluck('codigo','id');
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('ingreso_animals.create')->with('ingresoAnimal',0)->with('Fincas', $Fincas)->with('compra', $compra)->with('potreros', $potreros);
    }

    /**
     * Store a newly created IngresoAnimal in storage.
     *
     * @param CreateIngresoAnimalRequest $request
     *
     * @return Response
     */
    public function store(CreateIngresoAnimalRequest $request)
    {

        $ingresoAnimal = DB::table('ingreso_animals')
                                ->where('registro_compra_id',$request->registro_compra_id)
                                ->count();

        if($ingresoAnimal>0){

            //dd($ingresoAnimal);

            Flash::error('Este registro compra ya tiene ingreso.');

            //return redirect(route('ingresoAnimals.index'));
            return redirect('ingresoAnimals/');

        }else{

            //dd($ingresoAnimal);
            $input = $request->all();

            $data = Session::all();

            $input['users_id']=Auth::id();

            $input['fincas_id']=$data['finca'];

            $ingresoAnimal = $this->ingresoAnimalRepository->create($input);

            Flash::success('Ingreso Animal Guardado exitosamente.');

            //return redirect(route('ingresoAnimals.index'));
            return redirect('ingresoAnimals/'.$ingresoAnimal->id);

        }

    }

    /**
     * Display the specified IngresoAnimal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        //$ingresoAnimal = $this->ingresoAnimalRepository->findWithoutFail($id);

        $ingreso = DB::table('ingreso_animals')
                    ->where('id',$id)
                    ->where('fincas_id',$data['finca'])
                    ->select('registro_compra_id')
                    //->select('potreros.*', 'estado_protreros.descripcion')
                    ->get();

        $ingresoAnimal = DB::table('ingreso_animals')
                    ->join('registro_compras', 'ingreso_animals.registro_compra_id', '=', 'registro_compras.id')
                    ->where('ingreso_animals.fincas_id',$data['finca'])
                    ->where('ingreso_animals.registro_compra_id',$ingreso[0]->registro_compra_id)
                    ->select('ingreso_animals.*','ingreso_animals.id as ide','registro_compras.numero_compra','registro_compras.id as ide')
                    //->select('potreros.*', 'estado_protreros.descripcion')
                    ->get();


        $compra_lote = DB::table('compra_lote')
                    ->join('tipo_ganados', 'compra_lote.tipo_ganados_id', '=', 'tipo_ganados.id')
                    ->where('compra_lote.compra_lote_id',$ingresoAnimal[0]->registro_compra_id)
                    ->where('compra_lote.fincas_id',$data['finca'])
                    ->select('compra_lote.*','tipo_ganados.descripcion')
                    ->get();

        $lotes=DB::table('estaditica_compra')
                    ->join('compra_lote', 'estaditica_compra.id_compra_lote', '=', 'compra_lote.id')
                    ->join('tipo_ganados', 'compra_lote.tipo_ganados_id', '=', 'tipo_ganados.id')
                    ->where('id_registro_compras',$ingresoAnimal[0]->registro_compra_id)
                    ->where('estaditica_compra.fincas_id',$data['finca'])
                    ->select('estaditica_compra.*','estaditica_compra.id_compra_lote as ide','compra_lote.*','tipo_ganados.descripcion','tipo_ganados.id as tp')
                    ->get();


        $lotes2=DB::table('detalle_ingreso_animals')
                    ->join('potreros', 'detalle_ingreso_animals.potreros_id', '=', 'potreros.id')
                    ->join('tipo_ganados', 'detalle_ingreso_animals.tipo_ganados_id', '=', 'tipo_ganados.id')
                    ->where('registro_compra_lote_id',$ingresoAnimal[0]->id)
                    ->where('detalle_ingreso_animals.fincas_id',$data['finca'])
                    ->select('detalle_ingreso_animals.*','potreros.codigo','potreros.id as idp','tipo_ganados.descripcion as tipo')
                    ->get();

        $animales=DB::table('detalle_ingreso_animals2')
                    ->where('registro_compra_lote_id',$ingresoAnimal[0]->id)
                    ->where('detalle_ingreso_animals2.fincas_id',$data['finca'])
                    ->get();

        $animales_ingresados=DB::table('detalle_ingreso_animals2')
                    ->where('registro_compra_lote_id',$ingresoAnimal[0]->id)
                    ->where('detalle_ingreso_animals2.fincas_id',$data['finca'])
                    ->count();

        $detalle =DB::table('detalle_ingreso_animals')->where('detalle_ingreso_animals.fincas_id',$data['finca'])->get();



        $potreros = Potreros::all()->where('fincas_id',$data['finca'])->pluck('codigo','id');

        if (empty($ingresoAnimal)) {
            Flash::error('Ingreso Animal not found');

            return redirect(route('ingresoAnimals.index'));
        }

        $tipo_ganado = DB::table('tipo_ganados')->get();

        return view('ingreso_animals.show')
                                            ->with('ingresoAnimal', $ingresoAnimal)
                                            ->with('Fincas', $Fincas)->with('detalle', $detalle)
                                            ->with('compra_lote', $compra_lote)
                                            ->with('tipo_ganado', $tipo_ganado)
                                            ->with('potreros', $potreros)
                                            ->with('lotes', $lotes)
                                            ->with('animales', $animales)
                                            ->with('animales_ingresados', $animales_ingresados)
                                            ->with('lotes2', $lotes2);
    }

    /**
     * Show the form for editing the specified IngresoAnimal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ingresoAnimal = $this->ingresoAnimalRepository->findWithoutFail($id);

        if (empty($ingresoAnimal)) {
            Flash::error('Ingreso Animal not found');

            return redirect(route('ingresoAnimals.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        $compra =DB::table('registro_compras')
            ->select(DB::raw("CONCAT (numero_compra,' | ',fecha_compra)AS des"), 'id')
            ->pluck('des','id');

        $potreros = Potreros::all()->where('fincas_id',$data['finca'])->pluck('codigo','id');



        return view('ingreso_animals.edit')->with('ingresoAnimal', $ingresoAnimal)->with('Fincas', $Fincas)->with('compra', $compra)->with('potreros', $potreros);
    }

    /**
     * Update the specified IngresoAnimal in storage.
     *
     * @param  int              $id
     * @param UpdateIngresoAnimalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIngresoAnimalRequest $request)
    {
        $ingresoAnimal = $this->ingresoAnimalRepository->findWithoutFail($id);

        if (empty($ingresoAnimal)) {
            Flash::error('Ingreso Animal not found');

            return redirect(route('ingresoAnimals.index'));
        }

        $ingresoAnimal = $this->ingresoAnimalRepository->update($request->all(), $id);

        Flash::success('Ingreso Animal Actualizado con exito.');

        return redirect(route('ingresoAnimals.index'));
    }

    /**
     * Remove the specified IngresoAnimal from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ingresoAnimal = $this->ingresoAnimalRepository->findWithoutFail($id);

        if (empty($ingresoAnimal)) {
            Flash::error('Ingreso Animal not found');

            return redirect(route('ingresoAnimals.index'));
        }

        $this->ingresoAnimalRepository->delete($id);

        Flash::success('Ingreso Animal Borrado con exito.');

        return redirect(route('ingresoAnimals.index'));
    }

    public function ingreso(Request $request)
    {



        $data = Session::all();
        $IngresoLote = new IngresoLote;
        $IngresoLote->potreros_id = $request->potreros;
        $IngresoLote->observaciones = $request->observaciones;
        $IngresoLote->tipo_ganados_id = $request->tipo_ganado;
        $IngresoLote->registro_compra_lote_id = $request->registro_compra_lote;
        $IngresoLote->fincas_id = $data['finca'];
        $IngresoLote->users_id = Auth::id();

        $IngresoLote->save();

        Flash::success('Lote Ingresado exitosamente.');


        return redirect()->back();

    }

    public function delete_ingreso($id)
    {

        $IngresoLote = IngresoLote::find($id);
        $IngresoLote->delete();

        Flash::success('Lote Borrado con exito.');

        return redirect()->back();
    }

    public function delete_animal_ingreso($id)
    {

        $sql="SELECT * FROM pro_ubucacion_animal(0,'',0,0,0,$id,0,0,'DELETE')";

        DB::select($sql);
        $IngresoLoteAnimal = IngresoLoteAnimal::find($id);

        $IngresoLoteAnimal->delete();





        Flash::success('Animal Borrado con exito.');

        return redirect()->back();
    }

    public function add_ingreso_ganado(Request $request){

        $data = Session::all();
        $IngresoAnimal = new IngresoLoteAnimal;
        $IngresoAnimal->peso = $request->peso;
        $IngresoAnimal->observaciones = $request->observaciones;
        $IngresoAnimal->detalle_ingreso_animals_id = $request->detalle_ingreso1;
        $IngresoAnimal->registro_compra_lote_id = $request->registro_compra;
        $IngresoAnimal->estadistica_id = $request->estadistica_id;
        $IngresoAnimal->fincas_id = $data['finca'];
        $IngresoAnimal->users_id = Auth::id();

        $IngresoAnimal->save();

        $IngresoLoteAnimal= IngresoLoteAnimal::all();

        //dd($IngresoLoteAnimal->last()->id);

        $sql="SELECT * FROM pro_ubucacion_animal(0,'".$request->observaciones."',".$request->peso.",1,".$request->potreros_id.",".$IngresoLoteAnimal->last()->id.",".$data["finca"].",".Auth::id().",'INSERT')";


        DB::select($sql);



        Flash::success('Animal Ingresado exitosamente.');

        return redirect()->back();

    }

}






