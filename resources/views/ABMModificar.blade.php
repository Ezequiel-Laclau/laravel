
@extends("plantillaGeneral")
@section("contenido")
<script src="/js/ABMCrearYmodificar.js">
</script>
<div class="text-center">
    <h1>
        Modificar la película {{$pelicula->title}} de id {{$pelicula->id}}
    </h1>
</div>
<div class="d-flex">
    <!-- login box -->
    <div class="m-auto">
    <form method="post" action={{"/ABM/modificar/".$pelicula->id}} id="form-crear-pel" class="container-fluid" novalidate>
        {{ csrf_field() }}

        <div class="form-group">
            <label for="titulo">Título: </label>
            <input type="text" name="title" value="@if(old("title")===NULL && !$errors->has('title')) {{$pelicula->title}} @else {{old("title")}} @endif" id="titulo">
            <p>  @if ($errors->has('title')){{ $errors->first('title') }} @endif</p>
        </div>

        <div class="form-group">
            <label for="rating">Rating: </label>
            <input type="number" name="rating" value="@if(old("rating")===NULL  && !$errors->has('rating')){{$pelicula->rating}}@else{{old("rating")}}@endif" id="rating">
            <p>  @if ($errors->has('rating')){{ $errors->first('rating') }} @endif</p>
        </div>

        <div class="form-group">
            <label for="numeroDePremios">Número de premios: </label>
            <input type="number" name="awards" value="@if(old("awards")===NULL && !$errors->has('awards')){{$pelicula->awards}}@else{{old("awards")}}@endif" id="numeroDePremios">
            <p>  @if ($errors->has('awards')){{ $errors->first('awards') }} @endif</p>
        </div>


        <div>Fecha de estreno:</div>

        <div class="form-group">
                <label for="dia">Día: </label>
                <select name="dia" id="dia">
                    <option></option>
                    @if(old("dia")===NULL && !$errors->has('dia')) 

                    @for($dia=1;$dia<32;$dia++)
                        <option value="{{$dia}}"
                        @if($fecha["dia"]==$dia)
                    selected
                    @endif>{{$dia}}</option>
                    @endfor

                    @else

                    @for($dia=1;$dia<32;$dia++)
                    <option value="{{$dia}}"
                    @if(old("dia")==$dia)
                      selected
                    @endif>{{$dia}}</option>
                    @endfor

                    @endif
                    
                </select>
                <p>  @if ($errors->has('dia')){{ $errors->first('dia') }} @endif</p>
            </div>

            <div class="form-group">
                <label for="mes">Mes: </label>
                <select name="mes" id="mes">
                    <option></option>
                    @if(old("mes")===NULL && !$errors->has('mes')) 

                    @foreach($meses as $nroMesAnterior=>$nombreMes)
                    <option value="{{$nroMesAnterior+1}}"
                    @if($fecha["mes"]==$nroMesAnterior+1)
                    selected
                    @endif>{{$nombreMes}}</option>
                    @endforeach

                    @else

                    @foreach($meses as $nroMesAnterior=>$nombreMes)
                    <option value="{{$nroMesAnterior+1}}"
                    @if(old("mes")==$nroMesAnterior+1)
                      selected
                    @endif>{{$nombreMes}}</option>
                    @endforeach

                    @endif
                </select>
                <p>  @if ($errors->has('mes')){{ $errors->first('mes') }} @endif</p>
            </div>

            <div class="form-group">
                <label for="año">Año: </label>
                <select name="año" id="año">
                    <option></option>
                    @if(old("año")===NULL && !$errors->has('año')) 

                    @for($año=1895;$año<2021;$año++)
                        <option value="{{$año}}"
                        @if($fecha["año"]==$año)
                    selected
                    @endif>{{$año}}</option>
                    @endfor

                    @else

                    @for($año=1895;$año<2021;$año++)
                    <option value="{{$año}}"
                    @if(old("año")==$año)
                      selected
                    @endif>{{$año}}</option>
                    @endfor

                    @endif
                </select>
                <p>  @if ($errors->has('año')){{ $errors->first('año') }} @endif</p>
            </div>

            <div class="form-group">
            <label for="duracion">Duración (en minutos): </label>
            <input type="number" name="length" value="@if(Session::get("length")){{old("length")}}@else{{$pelicula->length}}@endif" id="duracion">
            <p>  @if ($errors->has('length')){{ $errors->first('length') }} @endif</p>
        </div>

        <div class="form-group">
            <label for="genero">Género: </label>
            <select name="genre" id="genero">
                <option></option>


                @if(Session::get("genre")) 

                @foreach($generos as $genero)
                <option value="{{$genero->id}}"
                @if(old("genre")==$genero->id)
                selected
                @endif>{{$genero->name}}</option>
                @endforeach

                @else

                @foreach($generos as $genero)
                <option value="{{$genero->id}}"
                    @if($pelicula->genre)
                    @if($pelicula->genre->id==$genero->id)
                    selected
                    @endif
                    @endif>{{$genero->name}}</option>
                @endforeach

                @endif

            </select>
        </div>

        <div id="cont-form-act-1" class="form-group">
            <label for="actor-1">Actor 1:</label>
            <select name="actor-1" id="actor-1">
                <option></option>


                @if(old("actor-1")===NULL && !$errors->has('actor-1')) 

                @foreach($actores as $actor)
                <option value="{{$actor->id}}"
                    @if($pelicula->actors[0]->id==$actor->id)
                    selected
                    @endif>{{$actor->first_name." ".$actor->last_name}}</option>
                @endforeach

                @else

                @foreach($actores as $actor)
                <option value="{{$actor->id}}"
                    @if(old("actor-1")==$actor->id)
                    selected
                    @endif>{{$actor->first_name." ".$actor->last_name}}</option>
                @endforeach

                @endif

            </select>
            <p>  @if ($errors->has('actor-1')){{ $errors->first('actor-1') }} @endif</p>
        </div>

        @for($limite=$cantidadActores;$limite>0;$limite--)
        @if(old("actor-".$limite)!==NULL)
        @for($i=2;$i<=$limite;$i++)
        <div id={{"cont-form-act-".$i}} class="form-group">
            <label for={{"actor-".$i}}>{{"Actor ".$i.":"}}</label>
            <select name={{"actor-".$i}} id={{"actor-".$i}}>
                <option></option>
                @foreach($actores as $actor)
                <option value="{{$actor->id}}"
                    @if(old("actor-".$i)==$actor->id)
                    selected
                    @endif>{{$actor->first_name." ".$actor->last_name}}</option>
                @endforeach
            </select>
            <p>  @if ($errors->has('actor-'.$i)){{ $errors->first('actor-'.$i) }} @endif</p>
        </div> 
        @endfor
        @break
        @endif

        @if($limite==1)
            @for($i=2;$i<=$cantidadActoresPelicula;$i++)
            <div id={{"cont-form-act-".$i}} class="form-group">
                <label for={{"actor-".$i}}>{{"Actor ".$i.":"}}</label>
                <select name={{"actor-".$i}} id={{"actor-".$i}}>
                    <option></option>
                    @foreach($actores as $actor)
                    <option value="{{$actor->id}}"
                        @if($pelicula->actors[$i-1]->id==$actor->id)
                        selected
                        @endif>{{$actor->first_name." ".$actor->last_name}}</option>
                    @endforeach
                </select>
                <p>  @if ($errors->has('actor-'.$i)){{ $errors->first('actor-'.$i) }} @endif</p>
            </div> 
            @endfor
        @endif

        @endfor
        <div id="btns-mdf-act">
            <button id="btn-agr-act" type="button">Agregar actor</button>
            <button id="btn-eli-act" type="button">Eliminar actor</button>
            </div>
        <input type="hidden" name="id" value="{{$pelicula->id}}">
            <div>
                <button type="submit">Modificar</button>
            </div>

            
        </form>

</div>
</div>

@endsection