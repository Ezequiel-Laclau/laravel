
@extends("plantillaGeneral")
@section("contenido")
<script src="/js/titulos.js">
</script>
<div class="container pt-3 pb-3">
    <form class="form-inline justify-content-center" id="Nav-Busc-Tit2">
        {{ csrf_field() }}
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar títulos" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
    </div>


    <div class="container text-center pb-3">
        <h1>Búsqueda de titulos</h1>
        </div>

        <div class="container">        
@foreach($coincidencias as $coincidencia)

<div class="row border border-secondary">

    <div class="col-sm-9 bg-primary float-left text-center">
{{$coincidencia->title}}
</div>

<div class="col-sm-3 bg-info float-right text-center">
    @if($coincidencia->genre!==NULL)
    {{$coincidencia->genre->name}}
    @else
    No hay datos
    @endif
</div>
</div>

@endforeach
</div>

<div class="container pt-3"  id="div-pag-bar">
{{$coincidencias->links()}}
</div>
@endsection