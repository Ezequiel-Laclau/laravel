
@extends("plantillaGeneral")
@section("contenido")
<script src="/js/ABM.js">
</script>
<div class="text-center">
    <form method="get" action="/ABM/crear" class="form-inline justify-content-center">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-outline-success">Agregar película</button>
    </form>    
    <h1>Lista de películas</h1>
</div>


    <div class="container">
    @foreach($peliculas as $pelicula)
    <div class="row border border-light rounded">
    <div class="col-sm-6 bg-secondary text-center ">
    {{$pelicula->title}}
    </div>
<div class="col-sm-6 container bg-dark">
    <div class="row">
    <div class="col-sm-6">
    <form method="get" action={{"/ABM/modificar/".$pelicula->id}} class="form-inline justify-content-center">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-outline-warning">Modificar</button>
    </form>
    </div>
    <div class="col-sm-6">
    <form method="post" action="/ABM" class="form-inline justify-content-center">
        {{ csrf_field() }}
        <button type="submit" name="eliminarPelicula" value={{$pelicula->id}} class="btn btn-outline-danger">Eliminar</button>
    </form>
    </div>
    </div>
</div>
</div>
    @endforeach
    </div>
    
    <div id="div-pag-bar">
    {{$peliculas->links()}}
    </div>
@endsection