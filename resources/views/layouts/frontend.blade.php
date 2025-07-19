{{-- resources/views/layouts/frontend.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portal FlaMídia - Notícias do Flamengo</title>

    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6AxyZyeTqjW0G8rJ9iQ+pajN" crossorigin="anonymous">

    <!-- Custom Frontend CSS (compilado pelo Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex-grow: 1;
        }

        footer {
            flex-shrink: 0;
        }
    </style>
</head>

<body>
    {{-- Navbar do Frontend --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Portal FlaMídia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#frontendNavbar" aria-controls="frontendNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="frontendNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('noticias.index') ? 'active' : '' }}" href="{{ route('noticias.index') }}">Notícias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('elenco') }}">Elenco</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('campeonatos') }}">Campeonatos</a>
                    </li>
                    {{-- O link para Extras foi removido --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contato') }}">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Conteúdo principal da página --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer do Frontend --}}
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="text-white">Sobre o Portal FlaMídia</h5>
                    <p class="text-white-50">
                        O Portal FlaMídia é uma página independente dedicada exclusivamente a cobrir o dia a dia do Clube de Regatas do Flamengo. Aqui, o torcedor encontra as últimas notícias, bastidores, análises, entrevistas e conteúdo especial sobre o Mais Querido do Brasil.
                        Criado por apaixonados pelo clube, o portal surgiu com o objetivo de informar com agilidade, responsabilidade e isenção, sem abrir mão da paixão rubro-negra que nos move.
                    </p>
                </div>
                <div class="col-md-6 mb-3 text-md-end">
                    <h5 class="text-white">Links Rápidos</h5>
                    <ul class="list-unstyled text-white-50">
                        <li><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                        <li><a href="{{ route('noticias.index') }}" class="text-white-50 text-decoration-none">Notícias</a></li>
                        <li><a href="{{ route('elenco') }}" class="text-white-50 text-decoration-none">Elenco</a></li>
                        <li><a href="{{ route('campeonatos') }}" class="text-white-50 text-decoration-none">Campeonatos</a></li>
                        {{-- O link para Extras no footer foi removido --}}
                        <li><a href="{{ route('login') }}" class="text-white-50 text-decoration-none">Login Admin</a></li>
                    </ul>
                </div>
            </div>
            <hr class="text-white-50">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Portal FlaMídia. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eGbVrC6kK3eN" crossorigin="anonymous"></script>
</body>

</html>