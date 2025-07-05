@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Painel Administrativo do Portal FlaMídia</h2>

    <div class="row">
        <div class="col-md-3 mb-4"> {{-- Ajustado para 4 colunas --}}
            <div class="card text-center h-100">
                <div class="card-body">
                    <h5 class="card-title">Gerenciar Notícias</h5>
                    <p class="card-text">Adicione, edite ou exclua notícias do portal.</p>
                    <a href="{{ route('admin.noticias.index') }}" class="btn btn-primary">Ir para Notícias</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4"> {{-- Ajustado para 4 colunas --}}
            <div class="card text-center h-100">
                <div class="card-body">
                    <h5 class="card-title">Gerenciar Categorias</h5>
                    <p class="card-text">Organize as notícias em diferentes categorias.</p>
                    <a href="{{ route('admin.categorias.index') }}" class="btn btn-info">Ir para Categorias</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4"> {{-- Card para Jogadores --}}
            <div class="card text-center h-100">
                <div class="card-body">
                    <h5 class="card-title">Gerenciar Jogadores</h5>
                    <p class="card-text">Adicione, edite ou exclua informações do elenco.</p>
                    <a href="{{ route('admin.players.index') }}" class="btn btn-warning">Ir para Jogadores</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4"> {{-- Novo card para Campeonatos --}}
            <div class="card text-center h-100">
                <div class="card-body">
                    <h5 class="card-title">Gerenciar Campeonatos</h5>
                    <p class="card-text">Adicione, edite ou exclua informações sobre campeonatos.</p>
                    <a href="{{ route('admin.championships.index') }}" class="btn btn-danger">Ir para Campeonatos</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4"> {{-- Novo card para Páginas --}}
            <div class="card text-center h-100">
                <div class="card-body">
                    <h5 class="card-title">Gerenciar Páginas</h5>
                    <p class="card-text">Edite o conteúdo de páginas.</p>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Ir para Páginas</a>
                </div>
            </div>
        </div>
    </div>
@endsection
