<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use App\actor;
use App\genre;
use App\movie;
class APIController extends Controller
{
    public function verAPI(){
        $peliculas=movie::all();
        $generos=genre::all();
        $actores=actor::all();
        $peliculas=$peliculas->all();
        $generos=$generos->all();
        $actores=$actores->all();
        return json_encode(["movies"=>$peliculas,"actors"=>$actores,"genres"=>$generos,"actor-movie"=>DB::table('actor_movie')->get()]);   
    }
}
