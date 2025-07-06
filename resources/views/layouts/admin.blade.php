<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - Portal FlaMídia</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

<body class="bg-light">
    <div class="min-h-screen">
        {{-- Admin Navbar (Menu Superior) --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin FlaMídia</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.noticias.index') }}">Notícias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.categorias.index') }}">Categorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.players.index') }}">Jogadores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.championships.index') }}">Campeonatos</a>
                        </li>
                        <li class="nav-item"> {{-- Link para Editar Contato --}}
                            <a class="nav-link" href="{{ route('admin.pages.contact.edit') }}">Editar Contato</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        @auth
                        <span class="navbar-text me-3">
                            Olá, {{ Auth::user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">Sair</button>
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                {{-- Mensagens Flash --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>