<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/css/plantillaGeneral.css" rel="stylesheet">
    <title>@yield("tituloPestaña")</title>
</head>
<body>
    <script src="/js/plantillaGeneral.js">
    </script>
    <div id="app">
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
                  <li class="nav-item active">
                    <a class="nav-link" href="/login">Login</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="/register">Register</a> 
                  </li>
                  
                </ul>
                  <form class="form-inline" id="Nav-Busc-Tit">
                    {{ csrf_field() }}
                    <input class="form-control mr-sm-2" type="search"  placeholder="Buscar títulos" aria-label="Search" >
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                  </form>
      
              </div>
            </nav>
      
          </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
