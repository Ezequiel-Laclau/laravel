@extends("plantillaGeneral")
@section("contenido")
        <div class="col text-center">
        <h1>5 películas random</h1>
        </div>
        <div class="container">
        @for($i=0;$i<5;$i++)
        <div class="col text-center">
                <a href={{"/pelicula/detalle/".$cincoRandoms[$i]->id}} class="list-group-item list-group-item-action list-group-item-primary"><h3>{{$cincoRandoms[$i]->title}}</h3></a>
        </div>
        @endfor
        </div>

        <div class="col text-center">
        <h1>Últimas 5 películas</h1>
        </div>
        <div class="container">
        @for($i=0;$i<5;$i++)
        <div class="col text-center">
                <a href={{"/pelicula/detalle/".$ultimas5[$i]->id}} class="list-group-item list-group-item-action list-group-item-primary"><h3>{{$ultimas5[$i]->title}}</h3></a>
        </div>    
        @endfor
        </div>
@endsection