<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\actor;
use App\genre;
use App\movie;
class peliculasController extends Controller
{
    public function verPeliculas(){
        $titulosEids=movie::select(["title", "id"])->get();
        $cincoRandoms=$titulosEids->shuffle()->random(5);
        $titulosEids=$titulosEids->sortByDesc("id");
        $contador=4;
        $ultimas5=[];
        foreach($titulosEids as $tituloEid){
            $ultimas5[$contador]=$tituloEid;
            $contador--;
            if($contador==-1){
            break;
            }
        }
        $ultimas5=collect($ultimas5)->sortBy("id");
        return view("inicio",compact("ultimas5","cincoRandoms"));
    }
    public function verPelicula($id=NULL){
        if($id===NULL || !is_numeric($id)){
            return redirect("/inicio");
        }
        $pelicula=movie::find($id);
        if(!isset($pelicula->id)){
            return redirect("/inicio");
        }
        $pelicula->release_date= date("Y/m/d", strtotime($pelicula->release_date));
        return view("peliculaDetalle",compact("pelicula"));
    }
}
