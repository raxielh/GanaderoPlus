<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateRegistroCompraRequest;
use App\Http\Requests\UpdateRegistroCompraRequest;
use App\Repositories\RegistroCompraRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Fincas;
use App\Models\estado_compra;
use App\Models\Compradores;
use App\Models\Vendedores;
use App\Models\ResponsableCompras;
use App\Models\LugarProcedencia;
use App\Models\Hierro;
use App\Models\RegistroCompra;
use App\Models\CompraLote;
use App\Models\CompraLoteGanado;
use App\Models\Empresa;
use App\Models\TipoCompra;
use App\Models\deduccion;
use App\Models\Pregunta_licencia;
use App\Models\PreguntaFacturas;
use Barryvdh\DomPDF\Facade as PDF;
use Session;


class RegistroCompraController extends AppBaseController
{
    /** @var  RegistroCompraRepository */
    private $registroCompraRepository;

    public function __construct(RegistroCompraRepository $registroCompraRepo)
    {
        $this->registroCompraRepository = $registroCompraRepo;
    }

    /**
     * Display a listing of the RegistroCompra.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->registroCompraRepository->pushCriteria(new RequestCriteria($request));
        //$registroCompras = $this->registroCompraRepository->all();

        $data = Session::all();


        $registroCompras = DB::table('registro_compras')
                    ->join('lugar_procedencias', 'registro_compras.lugar_procedencia_id', '=', 'lugar_procedencias.id')
                    ->join('vendedores', 'registro_compras.vendedor_id', '=', 'vendedores.id')
                    ->join('compradores', 'registro_compras.comprador_id', '=', 'compradores.id')
                    ->join('estado_compras', 'registro_compras.estado_id', '=', 'estado_compras.id')
                    ->join('empresas', 'registro_compras.empresas_id', '=', 'empresas.id')
                    ->where('registro_compras.fincas_id',$data['finca'])
                    ->select('vendedores.nombre as vendedor','compradores.nombre as comprador','estado_compras.descripcion as estado_compra','empresas.razon_social as razon_social','registro_compras.*','lugar_procedencias.descripcion as lugar_procedencias')
                    ->orderByRaw('registro_compras.id DESC')
                    //->select('potreros.*', 'estado_protreros.descripcion')
                    ->get();


        #$registroCompras = DB::table('registro_compras')->get();

        //dd($registroCompras);

        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        return view('registro_compras.index')
            ->with('registroCompras', $registroCompras)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for creating a new RegistroCompra.
     *
     * @return Response
     */
    public function create()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        $NumeroregistroCompras = DB::table('registro_compras')
                    ->where('registro_compras.fincas_id',$data['finca'])
                    ->select(DB::raw("count(*)"))
                    ->get();

        $estado_compra = estado_compra::all()->pluck('descripcion','id');
        $tipo_compras=TipoCompra::all()->pluck('descripcion','id');
        $Pregunta_licencia=Pregunta_licencia::all()->pluck('descripcion','id');
        $PreguntaFacturas=PreguntaFacturas::all()->pluck('descripcion','id');

        $empresa = Empresa::all()->where('fincas_id',$data['finca'])->pluck('razon_social','id');
        $Compradores=Compradores::all()->where('fincas_id',$data['finca'])->pluck('nombre','id');
        $Vendedores = Vendedores::all()->where('fincas_id',$data['finca'])->pluck('nombre','id');
        $ResponsableCompras=ResponsableCompras::all()->where('fincas_id',$data['finca'])->pluck('nombre','id');
        $LugarProcedencia=LugarProcedencia::all()->where('fincas_id',$data['finca'])->pluck('descripcion','id');
        $Hierro=Hierro::all()->where('fincas_id',$data['finca']);

        return view('registro_compras.create')
                    ->with('Fincas', $Fincas)
                    ->with('NumeroregistroCompras', $NumeroregistroCompras)
                    ->with('empresa', $empresa)
                    ->with('registroCompra', 0)
                    ->with('estado_compra', $estado_compra)
                    ->with('tipo_compras', $tipo_compras)
                    ->with('Compradores', $Compradores)
                    ->with('Vendedores', $Vendedores)
                    ->with('ResponsableCompras', $ResponsableCompras)
                    ->with('LugarProcedencia', $LugarProcedencia)
                    ->with('Pregunta_licencia', $Pregunta_licencia)
                    ->with('PreguntaFacturas', $PreguntaFacturas)
                    ->with('Hierro', $Hierro);
    }

    /**
     * Store a newly created RegistroCompra in storage.
     *
     * @param CreateRegistroCompraRequest $request
     *
     * @return Response
     */
    public function store(CreateRegistroCompraRequest $request)
    {
        $input = $request->all();
        $data = Session::all();

        $input['users_id']=Auth::id();

        $input['fincas_id']=$data['finca'];

        if($request->file('documento')){
            $documento=$request->file('documento')->store('public');
            $input['documento']=$documento;
        }

        if($request->file('documento_factura')){
            $documento_factura=$request->file('documento_factura')->store('public');
            $input['documento_factura']=$documento_factura;
        }

        //dd($input);

        $registroCompra = $this->registroCompraRepository->create($input);

        Flash::success('Registro Compra Guardado exitosamente.');

        return redirect('registroCompras/ficha/'.$registroCompra->id.'/ver');
    }

    /**
     * Display the specified RegistroCompra.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $registroCompra = $this->registroCompraRepository->findWithoutFail($id);

        if (empty($registroCompra)) {
            Flash::error('Registro Compra not found');

            return redirect(route('registroCompras.index'));
        }

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        return view('registro_compras.show')->with('registroCompra', $registroCompra)->with('Fincas', $Fincas);
    }

    /**
     * Show the form for editing the specified RegistroCompra.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $registroCompra = $this->registroCompraRepository->findWithoutFail($id);

        if (empty($registroCompra)) {
            Flash::error('Registro Compra not found');

            return redirect(route('registroCompras.index'));
        }

        $data = Session::all();

        $registroCompras = DB::table('registro_compras')
                    ->where('registro_compras.fincas_id',$data['finca'])
                    ->select('registro_compras.*',DB::raw("to_char(registro_compras.fecha_compra,'YYYY-MM-DD') as fecha_compra"))
                    ->get();

        //dd($registroCompras);
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        $deduccion=deduccion::all()->pluck('descripcion','id');
        $Pregunta_licencia=Pregunta_licencia::all()->pluck('descripcion','id');


        $estado_compra = estado_compra::all()->pluck('descripcion','id');
        $Compradores=Compradores::all()->where('fincas_id',$data['finca'])->pluck('nombre','id');
        $Vendedores = Vendedores::all()->where('fincas_id',$data['finca'])->pluck('nombre','id');
        $ResponsableCompras=ResponsableCompras::all()->where('fincas_id',$data['finca'])->pluck('nombre','id');
        $LugarProcedencia=LugarProcedencia::all()->where('fincas_id',$data['finca'])->pluck('descripcion','id');
        $Hierro=Hierro::all()->where('fincas_id',$data['finca']);

        $tipo_compras=TipoCompra::all()->pluck('descripcion','id');

        $empresa = Empresa::all()->where('fincas_id',$data['finca'])->pluck('razon_social','id');
        $PreguntaFacturas=PreguntaFacturas::all()->pluck('descripcion','id');

        return view('registro_compras.edit')
                    ->with('registroCompra', $registroCompra)
                    ->with('Fincas', $Fincas)
                    ->with('estado_compra', $estado_compra)
                    ->with('Compradores', $Compradores)
                    ->with('Vendedores', $Vendedores)
                    ->with('ResponsableCompras', $ResponsableCompras)
                    ->with('LugarProcedencia', $LugarProcedencia)
                    ->with('tipo_compras', $tipo_compras)
                    ->with('deduccion', $deduccion)
                    ->with('empresa', $empresa)
                    ->with('Pregunta_licencia', $Pregunta_licencia)
                    ->with('PreguntaFacturas', $PreguntaFacturas)
                    ->with('Hierro', $Hierro);
    }

    /**
     * Update the specified RegistroCompra in storage.
     *
     * @param  int              $id
     * @param UpdateRegistroCompraRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRegistroCompraRequest $request)
    {
        $registroCompra = $this->registroCompraRepository->findWithoutFail($id);

        if (empty($registroCompra)) {
            Flash::error('Registro Compra not found');

            return redirect(route('registroCompras.index'));
        }

        $datos=$request->all();

        if($request->file('documento')){
            $documento=$request->file('documento')->store('public');
            $datos['documento']=$documento;
        }

        if($request->file('documento_factura')){
            $documento_factura=$request->file('documento_factura')->store('public');
            $datos['documento_factura']=$documento_factura;
        }


        $registroCompra = $this->registroCompraRepository->update($datos, $id);

        Flash::success('Registro Compra Actualizado con exito.');

        return redirect(route('registroCompras.index'));
    }

    /**
     * Remove the specified RegistroCompra from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $registroCompra = $this->registroCompraRepository->findWithoutFail($id);

        if (empty($registroCompra)) {
            Flash::error('Registro Compra not found');

            return redirect(route('registroCompras.index'));
        }

        $this->registroCompraRepository->delete($id);

        Flash::success('Registro Compra Borrado con exito.');

        return redirect(route('registroCompras.index'));
    }

    public function add_ficha($id)
    {

        $data = Session::all();

        $registroCompras = DB::table('registro_compras')
                    ->join('lugar_procedencias', 'registro_compras.lugar_procedencia_id', '=', 'lugar_procedencias.id')
                    ->join('vendedores', 'registro_compras.vendedor_id', '=', 'vendedores.id')
                    ->join('compradores', 'registro_compras.comprador_id', '=', 'compradores.id')
                    ->join('estado_compras', 'registro_compras.estado_id', '=', 'estado_compras.id')
                    ->join('empresas', 'registro_compras.empresas_id', '=', 'empresas.id')
                    ->where('registro_compras.id',$id)
                    ->select('vendedores.nombre as vendedor','vendedores.direccion as direccion_v','vendedores.contacto as contacto_v','compradores.nombre as comprador','empresas.razon_social as razon_social','empresas.logo as logo','estado_compras.descripcion as estado_compra','registro_compras.*','lugar_procedencias.descripcion as lugar_procedencias')
                    ->get();

        $tipo_ganado = DB::table('tipo_ganados')->pluck('descripcion','id');

        $compra_lote = DB::table('compra_lote')
                        ->join('tipo_ganados', 'compra_lote.tipo_ganados_id', '=', 'tipo_ganados.id')
                        ->where('compra_lote.compra_lote_id',$id)
                        ->select('compra_lote.*','tipo_ganados.descripcion')
                        ->get();

        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        $CompraLoteGanado = CompraLoteGanado::where('users_id',Auth::id())
               ->where('fincas_id',$data['finca'])->get();

        $estadistica = DB::table('estaditica_compra')
                    ->join('tipo_ganados', 'estaditica_compra.tipo_ganados_id', '=', 'tipo_ganados.id')
                    ->where('id_registro_compras',$id)
                    ->select('estaditica_compra.*','tipo_ganados.descripcion as tipo')
                    ->get();

        $deduccion=deduccion::all()->pluck('descripcion','id');

        return view('registro_compras.add_ficha')
                ->with('registroCompras', $registroCompras)
                ->with('Fincas', $Fincas)
                ->with('tipo_ganado', $tipo_ganado)
                ->with('compra_lote', $compra_lote)
                ->with('estadistica', $estadistica)
                ->with('deduccion', $deduccion)
                ->with('CompraLoteGanado', $CompraLoteGanado);
    }

    public function add_lote(Request $request)
    {

        $data = Session::all();
        $CompraLote = new CompraLote;
        $CompraLote->tipo_ganados_id = $request->tipo_ganado;
        $CompraLote->compra_lote_id = $request->registro_compra;
        $CompraLote->precio = $request->precio;
        $CompraLote->observaciones = $request->observaciones;
        $CompraLote->deduccions_id = $request->deduccions_id;
        $CompraLote->deduccion = $request->deduccion;
        $CompraLote->fincas_id = $data['finca'];
        $CompraLote->estado_lote_id = 1;
        $CompraLote->users_id = Auth::id();
        $CompraLote->save();

        Flash::success('Lote Guardado exitosamente.');

        return redirect()->back();
    }

    public function add_lote_ganado(Request $request)
    {

        if($request->tipo==1){

            for ($i = 1; $i <= $request->cantidad; $i++) {

                $data = Session::all();
                $CompraLoteGanado = new CompraLoteGanado;
                $CompraLoteGanado->peso = $request->peso/$request->cantidad;
                $CompraLoteGanado->observaciones = $request->observaciones;
                $CompraLoteGanado->fincas_id = $data['finca'];
                $CompraLoteGanado->users_id = Auth::id();
                $CompraLoteGanado->compra_lote_id = $request->lote;

                $CompraLoteGanado->save();
            }

            Flash::success('Animales Guardado exitosamente.');

            DB::select('SELECT * FROM pro_estadistica_compra('.$request->registro_compra.','.$request->lote.')');

            return redirect()->back();

        }else{

            $data = Session::all();
            $CompraLoteGanado = new CompraLoteGanado;
            $CompraLoteGanado->peso = $request->peso;
            $CompraLoteGanado->observaciones = $request->observaciones;
            $CompraLoteGanado->fincas_id = $data['finca'];
            $CompraLoteGanado->users_id = Auth::id();
            $CompraLoteGanado->compra_lote_id = $request->lote;
            //return $CompraLoteGanado;
            $CompraLoteGanado->save();

            Flash::success('Animal Guardado exitosamente.');

            DB::select('SELECT * FROM pro_estadistica_compra('.$request->registro_compra.','.$request->lote.')');


            return redirect()->back();

        }

    }

    public function delete_lote($id)
    {

        $CompraLote = CompraLote::find($id);
        $CompraLote->delete();

        Flash::success('Registro de Lote Borrado con exito.');

        return redirect()->back();
    }

    public function delete_animal(Request $request,$id)
    {

        $CompraLoteGanado = CompraLoteGanado::find($id);
        $CompraLoteGanado->delete();

        DB::select('SELECT * FROM pro_estadistica_compra('.$request->registro_compra.','.$request->lote.')');

        Flash::success('Registro de Animal Borrado con exito.');

        return redirect()->back();
    }

    public function pdf($id)
    {

        $data = Session::all();

        $registroCompras = DB::table('registro_compras')
                    ->join('lugar_procedencias', 'registro_compras.lugar_procedencia_id', '=', 'lugar_procedencias.id')
                    ->join('vendedores', 'registro_compras.vendedor_id', '=', 'vendedores.id')
                    ->join('compradores', 'registro_compras.comprador_id', '=', 'compradores.id')
                    ->join('estado_compras', 'registro_compras.estado_id', '=', 'estado_compras.id')
                    ->join('empresas', 'registro_compras.empresas_id', '=', 'empresas.id')
                    ->where('registro_compras.id',$id)
                    ->select('vendedores.nombre as vendedor','vendedores.direccion as direccion_v','vendedores.contacto as contacto_v','compradores.nombre as comprador','empresas.razon_social as razon_social','empresas.logo as logo','estado_compras.descripcion as estado_compra','registro_compras.*','lugar_procedencias.descripcion as lugar_procedencias')
                    ->get();

        $tipo_ganado = DB::table('tipo_ganados')->pluck('descripcion','id');

        $compra_lote = DB::table('compra_lote')
                        ->join('tipo_ganados', 'compra_lote.tipo_ganados_id', '=', 'tipo_ganados.id')
                        ->where('compra_lote.compra_lote_id',$id)
                        ->select('compra_lote.*','tipo_ganados.descripcion')
                        ->get();

        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        $CompraLoteGanado = CompraLoteGanado::where('users_id',Auth::id())
               ->where('fincas_id',$data['finca'])->get();

        $estadistica = DB::table('estaditica_compra')
                    ->join('tipo_ganados', 'estaditica_compra.tipo_ganados_id', '=', 'tipo_ganados.id')
                    ->where('id_registro_compras',$id)
                    ->select('estaditica_compra.*','tipo_ganados.descripcion as tipo')
                    ->get();

        $deduccion=deduccion::all()->pluck('descripcion','id');


        $pdf = PDF::loadView('pdf.RegistroCompra',compact('registroCompras','Fincas','tipo_ganado','compra_lote','CompraLoteGanado','estadistica'));


        return $pdf->download('Registro_de_Compra.pdf');
/*
        return view('pdf.RegistroCompra')
                    ->with('Fincas', $Fincas)
                    ->with('registroCompras', $registroCompras);

*/



    }

}
