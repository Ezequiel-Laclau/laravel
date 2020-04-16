<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\actor;
use App\genre;
use App\movie;
class ABMController extends Controller
{
    const errores=[
        "length.nullable" =>"Length es null",
        "title.required" =>"El titulo es obligatorio",
        "rating.required" =>"El rating es obligatorio",
        "awards.required" =>"El numero de premios es obligatorio",
        "dia.required" =>"El día es obligatorio",
        "mes.required" =>"El mes es obligatorio",
        "año.required" =>"El año es obligatorio",
        "rating.numeric"=>"El rating debe ser un numero",
        "awards.numeric"=>"El numero de premios debe ser un numero",
        "dia.numeric"=>"El numero de dia debe ser un numero",
        "mes.numeric"=>"El numero de mes debe ser un numero",
        "año.numeric"=>"El numero de año debe ser un numero",
        "length.numeric"=>"La duracion en minutos debe ser un numero",
        "rating.min"=>"El rating no puede ser menor a :min puntos",
        "awards.min"=>"Numero de premios incorrecto",
        "dia.min"=>"El numero de día no puede ser menor a :min",
        "mes.min"=>"El numero de mes no puede ser menor a :min",
        "año.min"=>"El numero de año no puede ser menor a :min",
        "length.min"=>"Duracion de película incorrecta",
        "title.max"=>"El titulo no puede tener mas de :max caracteres",
        "rating.max"=>"El rating no puede ser mayor a :max puntos",
        "dia.max"=>"El numero de dia no puede ser mayor a :max",
        "mes.max"=>"El numero de mes no puede ser mayor a :max",
        "año.max"=>"El numero de año no puede ser mayor a :max",
        "length.max"=>"La película no puede durar más de :max minutos",
        "awards.integer"=>"El numero de premios debe ser un entero",
        "dia.integer"=>"El numero de dia debe ser un entero",
        "mes.integer"=>"El numero de mes debe ser un entero",
        "año.integer"=>"El numero de año debe ser un entero"
        ];

    const validaciones=
    [
        "title"=>"required|max:500",
        "rating"=>"required|numeric|min:0|max:10",
        "awards"=>"required|numeric|integer|min:0",
        "dia"=>"required|numeric|integer|min:1|max:31",
        "mes"=>"required|numeric|integer|min:1|max:12",
        "año"=>"required|numeric|integer|min:1895|max:2020",
        "length"=>"nullable|numeric|min:1|max:51420",
    ];

    const meses=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

    public function verPeliculas(){
        $peliculas = movie::paginate(10);
        return view("ABM",compact(["peliculas"]));
    }

    public function eliminarPelicula(Request $datos){
        if(is_numeric($datos["eliminarPelicula"])){
            $id=$datos["eliminarPelicula"];
            $peliculaAeliminar=movie::find($id);
            $peliculaAeliminar->actors()->detach();
            $peliculaAeliminar->delete();
        }
        
        return redirect("ABM");
    }

    public function modificarPelicula($id=NULL){
        if($id===NULL || !is_numeric($id)){
            return redirect("/ABM");
        }
        $pelicula=movie::find($id);
        if(!isset($pelicula->id)){
            return redirect("/ABM");
        }
        
        $pelicula=movie::find($id);
        $meses=self::meses;
        $actores=actor::all();
        $actores=$actores->sortBy(function($actor,$clave){
            return $actor->first_name." ".$actor->last_name;
        });
        $generos=genre::all();
        $generos=$generos->sortBy("name");
        $cantidadActores=count($actores);
        $cantidadActoresPelicula=count($pelicula->actors);

        $fecha=[];
        $fecha["dia"]=date("j",strtotime($pelicula->release_date));
        $fecha["mes"]=date("n",strtotime($pelicula->release_date));
        $fecha["año"]=date("Y",strtotime($pelicula->release_date));

        /*$idsActoresPelicula=[];
        $actoresPelicula=$pelicula->actors;
        foreach($actoresPelicula as $actorPelicula){
            $idsActoresPelicula[]=$actorPelicula->id;
        }*/
        return view("ABMModificar",compact("pelicula","actores","generos","meses","fecha","cantidadActores","cantidadActoresPelicula"));
    }
    public function validarModificacion(Request $form){

        $contador=0;
        foreach($form->all() as $name=>$value){
            if(preg_match("/actor/",$name)){
                $contador++;
            }
        }
        $validaciones=self::validaciones;
        for($i=0;$i<$contador;$i++){
            $validaciones["actor-".($i+1)]="required";
        }

        $errores=self::errores;
        for($i=0;$i<$contador;$i++){
            $errores["actor-".($i+1).".required"]="No seleccionaste el nombre del actor";
        }
        Session::flash("length",true);
        Session::flash("genre",true);
        $this->validate($form,$validaciones,$errores);
        $pelicula=movie::find($form["id"]);
        $pelicula->title=$form["title"];
        $pelicula->rating=$form["rating"];
        $pelicula->awards=$form["awards"];
        $pelicula->release_date=$form["año"]."-".$form["mes"]."-".$form["dia"]." 00:00:00";
        $pelicula->length=$form["length"];
        if($form["genre"]!==NULL){
            //$pelicula->genre_id=$form["genre"]; <--- otra manera de hacerlo
            $pelicula->genre()->associate(genre::find($form["genre"]));
        }else{
            $pelicula->genre_id=NULL;
        }
        $pelicula->save();
        $actores=[];
        foreach($form->all() as $name=>$value){
            if(preg_match("/actor/",$name)){
                $actores[]=$value;
            }
        }
        $actores=collect($actores)->unique()->sort()->all();
       $pelicula->actors()->sync($actores);
       $pelicula->save();
        return redirect("/ABM");
    }

    public function crearPelicula(){
        $meses=self::meses;
        $actores=actor::all();
        $actores=$actores->sortBy(function($actor,$clave){
            return $actor->first_name." ".$actor->last_name;
        });
        $generos=genre::all();
        $generos=$generos->sortBy("name");
        $cantidadActores=count($actores);
        return view("ABMCrear",compact("actores","generos","meses","cantidadActores"));
    }
    public function validarCreacion(Request $form){
        $contador=0;
        foreach($form->all() as $name=>$value){
            if(preg_match("/actor/",$name)){
                $contador++;
            }
        }
        $validaciones=self::validaciones;
        for($i=0;$i<$contador;$i++){
            $validaciones["actor-".($i+1)]="required";
        }

        $errores=self::errores;
        for($i=0;$i<$contador;$i++){
            $errores["actor-".($i+1).".required"]="No seleccionaste el nombre del actor";
        }

        $this->validate($form,$validaciones,$errores);
        $pelicula = new movie();
        $pelicula->title=$form["title"];
        $pelicula->rating=$form["rating"];
        $pelicula->awards=$form["awards"];
        $pelicula->release_date=$form["año"]."-".$form["mes"]."-".$form["dia"]." 00:00:00";
        $pelicula->length=$form["length"];
        if($form["genre"]!==NULL){
            //$pelicula->genre_id=$form["genre"]; <--- otra manera de hacerlo
            $pelicula->genre()->associate(genre::find($form["genre"]));
        }
        $pelicula->save();
        $actores=[];
        foreach($form->all() as $name=>$value){
            if(preg_match("/actor/",$name)){
                $actores[]=$value;
            }
        }
        $actores=collect($actores)->unique()->sort()->all();
       $pelicula->actors()->attach($actores);
       $pelicula->save();
        return redirect("/ABM");
    }
}
