<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Fincas;
use Flash;
use Session;

class FincasController extends Controller
{
    public function store(Request $request){

    	$Fincas = new Fincas;
        $Fincas->nombre = $request->nombre;
        $Fincas->descripcion = $request->descripcion;
        $Fincas->lat = $request->lat;
        $Fincas->lon = $request->lon;
        $Fincas->users_id = Auth::id();
        $Fincas->save();

    	return redirect(route('fincas'));

    }

    public function update(Request $request){

    	$Fincas = Fincas::find($request->id);
    	$Fincas->nombre = $request->nombre;
        $Fincas->descripcion = $request->descripcion;
        $Fincas->lat = $request->lat;
        $Fincas->lon = $request->lon;
        $Fincas->save();
        return redirect(route('fincas'));

    }

    public function delete($id)
    {
        $Fincas = Fincas::find($id);
        $Fincas->delete();
        Flash::success('Finca Borrada con exito.');
        return redirect(route('fincas'));
    }

    public function elegir_finca(Request $request)
    {
        session(['finca' =>$request->finca]);
        $data = Session::all();
        $Fincas = Fincas::find($data['finca']);
        //dd($Fincas->id);
        if( $Fincas->id ){
            return redirect(route('app'));
        }else{
            return redirect(route('fincas'));
        }

    }

}



