@extends('layouts.admin')

@section('content')
<h2 class="mb-4">Painel Administrativo do Portal FlaMídia</h2>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <h5 class="card-title">Gerenciar Notícias</h5>
                <p class="card-text">Adicione, edite ou exclua notícias do portal.</p>
                <a href="{{ route('admin.noticias.index') }}" class="btn btn-primary">Ir para Notícias</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <h5 class="card-title">Gerenciar Categorias</h5>
                <p class="card-text">Organize as notícias em diferentes categorias.</p>
                <a href="{{ route('admin.categorias.index') }}" class="btn btn-info">Ir para Categorias</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <h5 class="card-title">Gerenciar Jogadores</h5>
                <p class="card-text">Adicione, edite ou exclua informações do elenco.</p>
                <a href="{{ route('admin.players.index') }}" class="btn btn-warning">Ir para Jogadores</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <h5 class="card-title">Gerenciar Campeonatos</h5>
                <p class="card-text">Adicione, edite ou exclua informações sobre campeonatos.</p>
                <a href="{{ route('admin.championships.index') }}" class="btn btn-danger">Ir para Campeonatos</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4"> {{-- Card para Editar Contato --}}
        <div class="card text-center h-100">
            <div class="card-body">
                <h5 class="card-title">Editar Página Contato</h5>
                <p class="card-text">Atualize o conteúdo da sua página de contato.</p>
                <a href="{{ route('admin.pages.contact.edit') }}" class="btn btn-success">Ir para Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection