<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/plantillaGeneral.css" rel="stylesheet">
    <title>@yield("tituloPestaña")</title>
</head>
<body>
  <script src="/js/app.js">
    </script>
      <script src="/js/plantillaGeneral.js">
      </script>
    <header>
      <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample03" style="">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
             <li class="nav-item active">
              <a class="nav-link" href="/inicio">Inicio</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="/titulos">Títulos</a> 
            </li>
            @if(Auth::user())
            <li class="nav-item active">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
              Logout
          </a>
        </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>          
            @else
            <li class="nav-item active">
              <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="/register">Register</a> 
            </li>
            @endif

            @if(Auth::user()->email==="admin@admin.com")
            <li class="nav-item active">
              <a class="nav-link" href="/ABM">Administrar</a>
            </li>
            @endif
            
          </ul>
            <form class="form-inline" id="Nav-Busc-Tit">
              {{ csrf_field() }}
              <input class="form-control mr-sm-2" type="search"  placeholder="Buscar títulos" aria-label="Search" >
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>

        </div>
      </nav>

    </header>

    <main>
    @yield("contenido")
    </main>

    <footer>
    </footer>

</body>
</html>