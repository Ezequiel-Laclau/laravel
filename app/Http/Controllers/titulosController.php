<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\genre;
use App\movie;
class titulosController extends Controller
{
    public function verTitulos(){
        $titulos=movie::paginate(10);
        return view("titulos",compact("titulos"));
    }
    public function buscarTitulos($busqueda=NULL){
        if($busqueda===NULL){
            return redirect("/titulos");
        }
        $coincidencias=movie::where("title","LIKE",'%'.$busqueda.'%')->paginate(10);
        return view("titulosBusqueda",compact(["coincidencias"]));

    }

}
