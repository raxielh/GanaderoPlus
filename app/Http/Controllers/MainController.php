<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Fincas;
use Flash;
use Session;

class MainController extends Controller
{
    public function index(){
        $data = Session::all();
        $Fincas = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        $F = Fincas::where('users_id',Auth::id())
               ->where('id',$data['finca'])->get();
        return view('main.index')->with('Fincas', $Fincas)->with('F', $F);
    }
}



