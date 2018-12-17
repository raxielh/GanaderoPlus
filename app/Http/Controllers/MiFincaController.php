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

class MiFincaController extends AppBaseController
{

    public function index()
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        $potreros = DB::table('potreros')
                    ->join('estado_protreros', 'potreros.estado_id', '=', 'estado_protreros.id')
                    ->where('potreros.fincas_id',$data['finca'])
                    ->select('potreros.*', 'estado_protreros.descripcion')
                    ->get();

        $potreros2 = DB::select(' select potreros.codigo,potreros.area,count(*) as cantidad,potreros.id as potreros_id from ubicacion_animal,potreros
        where ubicacion_animal.potreros_id=potreros.id and
        potreros.fincas_id=?
        group by potreros.codigo,potreros.area,potreros.id', [$data['finca']]);

        $detalle_ingreso_animals=DB::table('detalle_ingreso_animals')
                    ->join('potreros', 'detalle_ingreso_animals.potreros_id', '=', 'potreros.id')
                    ->where('detalle_ingreso_animals.fincas_id',$data['finca'])
                    ->select('detalle_ingreso_animals.*','potreros.codigo','potreros.id as p_id')
                    ->get();

        $detalle_ingreso_animals2=DB::table('detalle_ingreso_animals2')
                    ->where('detalle_ingreso_animals2.fincas_id',$data['finca'])
                    ->get();

        $animales=DB::table('ubicacion_animal')
                    ->where('fincas_id',$data['finca'])
                    ->where('estado_id',1)
                    ->get();

        return view('mi_finca.index')
            ->with('potreros', $potreros)
            ->with('potreros2', $potreros2)
            ->with('detalle_ingreso_animals', $detalle_ingreso_animals)
            ->with('detalle_ingreso_animals2', $detalle_ingreso_animals2)
            ->with('animales', $animales)
            ->with('Fincas', $Fincas);
    }

    public function transferencia(Request $request)
    {
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();


        $potreros2 = DB::select('UPDATE ubicacion_animal SET potreros_id = ? WHERE id= ?', [$request->potreros_id,$request->id]);

        Flash::success('Transferencia con exito.');

        return redirect()->back();
    }

    public function rotar($id)
    {

        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();

        $potreros = DB::table('potreros')
                    ->join('estado_protreros', 'potreros.estado_id', '=', 'estado_protreros.id')
                    ->where('potreros.fincas_id',$data['finca'])
                    ->select('potreros.*', 'estado_protreros.descripcion')
                    ->get();

        $animales=DB::table('ubicacion_animal')
                    ->where('fincas_id',$data['finca'])
                    ->where('potreros_id',$id)
                    ->where('estado_id',1)
                    ->get();

        return view('mi_finca.rotar')
        ->with('potreros', $potreros)
        ->with('animales', $animales)
        ->with('Fincas', $Fincas);
    }

}
