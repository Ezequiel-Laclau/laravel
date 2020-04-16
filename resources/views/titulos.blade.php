@extends("plantillaGeneral")
@section("contenido")
<script src="/js/titulos.js">
</script>
<div class="container-fluid"> 
<div class="container pt-3 pb-3">
<form class="form-inline justify-content-center" id="Nav-Busc-Tit2">
    {{ csrf_field() }}
    <input class="form-control mr-sm-2" type="search" placeholder="Buscar títulos" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
</form>
</div>

<div class="container text-center pb-3">
<h1>Lista de titulos</h1>
</div>


<div class="container">
@foreach($titulos as $titulo)
<div class="row border border-dark">

<div class="col-sm-9 bg-primary text-center">
{{$titulo->title}}
</div>

<div class="col-sm-3 bg-info text-center">
    @if($titulo->genre!==NULL)
    {{$titulo->genre->name}}
    @else
    No hay datos
    @endif
</div>

</div>

@endforeach
</div>

<div class="container pt-3" id="div-pag-bar">
{{$titulos->links()}}
</div>
</div>
@endsection