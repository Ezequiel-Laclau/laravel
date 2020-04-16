
@extends("plantillaGeneral")
@section("contenido")
<script src="/js/ABMCrearYmodificar.js">
</script>
    <div class="text-center">
        <h1>
            Agregar una película
        </h1>
    </div>
    <div class="d-flex">
        <!-- login box -->
        <div class="m-auto">
        <form method="post" action="/ABM/crear" id="form-crear-pel" class="container-fluid" novalidate>

            {{ csrf_field() }}

            <div class="form-group">
                <label for="titulo" class="">Título: </label>
                <input type="text" name="title" value="{{old("title")}}" id="titulo">
                <p>  @if ($errors->has('title')){{ $errors->first('title') }} @endif</p>
            </div>

            <div class="form-group">
                <label for="rating">Rating: </label>
                <input type="number" name="rating" value="{{old("rating")}}" id="rating">
                <p>  @if ($errors->has('rating')){{ $errors->first('rating') }} @endif</p>
            </div>

            <div class="form-group">
                <label for="numeroDePremios">Número de premios: </label>
                <input type="number" name="awards" value="{{old("awards")}}" id="numeroDePremios">
                <p>  @if ($errors->has('awards')){{ $errors->first('awards') }} @endif</p>
            </div>

            
                <div>Fecha de estreno:</div>
                     <div class="form-group">
                    <label for="dia">Día: </label>
                    <select name="dia" id="dia">
                        <option></option>
                        @for($dia=1;$dia<32;$dia++)
                            <option value="{{$dia}}"
                            @if(old("dia")==$dia)
                        selected
                        @endif>{{$dia}}</option>
                        @endfor
                    </select>
                    <p>  @if ($errors->has('dia')){{ $errors->first('dia') }} @endif</p>
                </div>

                <div class="form-group">
                    <label for="mes">Mes: </label>
                    <select name="mes" id="mes">
                        <option></option>
                        @foreach($meses as $nroMesAnterior=>$nombreMes)
                        <option value="{{$nroMesAnterior+1}}"
                        @if(old("mes")==$nroMesAnterior+1)
                        selected
                        @endif>{{$nombreMes}}</option>
                        @endforeach
                    </select>
                    <p>  @if ($errors->has('mes')){{ $errors->first('mes') }} @endif</p>
                </div>

                <div class="form-group">
                    <label for="año">Año: </label>
                    <select name="año" id="año">
                        <option></option>
                        @for($año=1895;$año<2021;$año++)
                            <option value="{{$año}}"
                            @if(old("año")==$año)
                        selected
                        @endif>{{$año}}</option>
                        @endfor
                    </select>
                    <p>  @if ($errors->has('año')){{ $errors->first('año') }} @endif</p>
                </div>

             <div class="form-group">
                <label for="duracion">Duración (en minutos): </label>
                <input type="number" name="length" value="{{old("length")}}" id="duracion">
                <p>  @if ($errors->has('length')){{ $errors->first('length') }} @endif</p>
            </div>

            <div class="form-group">
                <label for="genero">Género: </label>
                <select name="genre" id="genero">
                    <option></option>
                    @foreach($generos as $genero)
                    <option value="{{$genero->id}}" 
                        @if(old("genre")==$genero->id)
                        selected
                        @endif>{{$genero->name}}</option>
                    @endforeach
                </select>
            </div>

            <div id="cont-form-act-1" class="form-group">
                <label for="actor-1">Actor 1:</label>
                <select name="actor-1" id="actor-1">
                    <option></option>
                    @foreach($actores as $actor)
                    <option value="{{$actor->id}}"
                        @if(old("actor-1")==$actor->id)
                        selected
                        @endif>{{$actor->first_name." ".$actor->last_name}}</option>
                    @endforeach
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
            @endfor

            <div id="btns-mdf-act">
            <button id="btn-agr-act" type="button">Agregar actor</button>
            <button id="btn-eli-act" type="button">Eliminar actor</button>
            </div>

            <div>
                <button type="submit">Agregar</button>
            </div>
        </form>
    </div>
</div>
@endsection