<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav_style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style type="text/css">
    #sidebar {
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 999;
        background: #7386D5;
        color: #fff;
        transition: all 0.3s;
    }
    .div_contenido{
        margin-left:20%;
    }
    .boton_menu{
        color:white;
    }
    .boton_menu:hover{
        cursor: pointer;
    }
</style>
<body>
    <div id="app">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Laravel</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Menu</p>
                <li>
                    <a href="/home" class="boton_menu">Home</a>
                </li>
                @if(Auth::user()->hasRole('admin'))
                <li class="active">
                    <a href="#homeSubmenuAdm" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Administrar</a>
                    <ul class="collapse list-unstyled" id="homeSubmenuAdm">
                        <li>
                            <a class="boton_menu" href="/usuarios">Usuarios</a>
                        </li>
                        <li>
                            <a class="boton_menu" href="/historial_archivo_admin">Administrar archivos</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->acceso(1))
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Archivos</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        @if(Auth::user()->acceso(2))
                        <li>
                            <a class="boton_menu" href="/archivo">Subir un archivo</a>
                        </li>
                        @endif
                        @if(Auth::user()->acceso(3))
                        <li>
                            <a class="boton_menu" href="/historial">Ver historial de archivos</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                <li>
                    <a id="logout" class="boton_menu">Cerrar sesión</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                        @csrf
                    </form>
                </li>
            </ul>

        </nav>

        <main class="div_contenido py-2">
            @yield('content')
        </main>
    </div>
    {{-- onclick="event.preventDefault();document.getElementById('logout-form').submit();" --}}

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
        document.getElementById("logout").onclick=()=>{
            document.getElementById('logout-form').submit()
        };
    </script>
</body>
</html>
