<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonte do Google  -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        
        <!-- CSS da aplicação -->
        <link rel="stylesheet" href="/css/styles.css">
        

        <!-- Ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="/js/script.js"></script>

    </head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbar">
                <a href="/" class="navbar-brand">
                    <img class= "navbar-brand-img"src="/img/Doc 4 you.png" alt="Logo da doc 4 you">
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/especialidades" class="nav-link">Especialidades</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a href="/consultas/create" class="nav-link">Agendar consulta</a>
                    </li>
                    <li class="nav-item">
                        <a href="/pacientes/create" class="nav-link">Cadastrar Paciente</a>
                    </li>
                    <li class="nav-item">
                        <a href="/consultas" class="nav-link">Minhas consultas</a>
                    </li>
                    <li class="nav-item">
                        <form action="/logout" method="POST" >
                            @csrf
                            <a href="/logout" class="nav-link" onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                Logout
                            </a>
                        </form>
                    </li>
                    @endauth
                    @guest
                    <li class="nav-item">
                        <a href="/register" class="nav-link">Cadastre-se</a>
                    </li>
                    <li class="nav-item">
                        <a href="/login" class="nav-link">Login</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav> 

    </header>
    <main>
        <div class="container-fluid">
            <div class="row">
                @if(session('msg'))
                    <p class="msg">{{session('msg')}}</p>
                @endif
                @yield('content')    
            </div>
        </div>
    </main>
    <footer>
        <p>
            Doc 4 you ©️ 2024
        </p>
    </footer>
    
</body>
</html>