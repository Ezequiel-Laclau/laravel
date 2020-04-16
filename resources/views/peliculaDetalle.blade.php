@extends("plantillaGeneral")
@section("contenido")
<div class="container-fluid">

<div class="container text-center pb-3">
<h1>{{$pelicula->title}}</h1>
</div>

<div class="container">
<div class="row border border-dark">
<div class="col-sm-3 bg-primary">
Título:
</div>
<div class="col-sm-9 bg-info">
{{$pelicula->title}}
</div>
</div>
<div class="row border border-dark">
<div class="col-sm-3 bg-primary">
Datos:
</div>
<div class="col-sm-9 container">

<div class="row border border-dark border-top-0 border-right-0 border-left-0">
<div class="col-sm-3 bg-secondary">
Duración:
</div>
<div class="col-sm-9 bg-info">
@if($pelicula->length!==NULL)
{{$pelicula->length." minutos"}}
@else
No data
@endif
</div>
</div>

<div class="row border border-dark border-top-0 border-right-0 border-left-0">
<div class="col-sm-3 bg-secondary">
Género:
</div>
<div class="col-sm-9 bg-info"> 
    @if($pelicula->genre!==NULL)
    {{$pelicula->genre->name}}
    @else
    No data
    @endif
</div>
</div>

<div class="row border border-dark border-top-0 border-right-0 border-left-0">
<div class="col-sm-3 bg-secondary">
Fecha de estreno:
</div>
<div class="col-sm-9 bg-info">
{{$pelicula->release_date}}
</div>
</div>

<div class="row border border-dark border-top-0 border-right-0 border-left-0">
<div class="col-sm-3 bg-secondary">
Rating:
</div>
<div class="col-sm-9 bg-info">
{{$pelicula->rating}}/10
</div>
</div>

<div class="row border border-dark border-top-0 border-right-0 border-left-0">
<div class="col-sm-3 bg-secondary">
Rating:
</div>
<div class="col-sm-9 bg-info">
{{$pelicula->rating}}/10
</div>
</div>

<div class="row">
<div class="col-sm-3 bg-secondary">
Cantidad de premios:
</div>
<div class="col-sm-9 bg-info">
{{$pelicula->awards}}/10
</div>
</div>

</div>
</div>

<div class="row border border-dark">
<div class="col-sm-3 bg-primary">
Lista de actores
</div>
<div class="col-sm-9 bg-info container">
@foreach($pelicula->actors as $actor)
<div class="row border border-dark border-top-0 border-right-0 border-left-0">{{$actor->first_name." ".$actor->last_name}}</div>
@endforeach
</div>
</div>

</div>
</div>
@endsection