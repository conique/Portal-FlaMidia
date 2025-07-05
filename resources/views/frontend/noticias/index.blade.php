@extends('layouts.frontend')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Todas as Notícias do Portal FlaMídia</h1>

        {{-- O bloco abaixo foi removido pois pertencia à interface do ADMIN --}}
        {{--
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Lista de Notícias</h3>
            <a href="{{ route('admin.categorias.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Nova Categoria
            </a>
        </div>
        --}}

        @if ($noticias->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                Nenhuma notícia encontrada no momento.
            </div>
        @else
            <div class="row">
                @foreach ($noticias as $noticia)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 noticia-card">
                            @if ($noticia->imagem_principal)
                                <img src="{{ Storage::url($noticia->imagem_principal) }}" class="card-img-top" alt="{{ $noticia->titulo }}">
                            @else
                                <img src="https://via.placeholder.com/400x250?text=Sem+Imagem" class="card-img-top" alt="Sem Imagem">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $noticia->titulo }}</h5>
                                <p class="card-text">
                                    Categoria: <span class="badge bg-secondary">{{ $noticia->category->nome ?? 'Sem Categoria' }}</span>
                                </p>
                                <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($noticia->conteudo), 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">{{ $noticia->published_at ? $noticia->published_at->format('d/m/Y') : 'Data Indefinida' }}</small>
                                    <a href="{{ route('noticias.show', $noticia->slug) }}" class="btn btn-sm btn-danger">Ler Mais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Links de Paginação --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $noticias->links() }}
            </div>
        @endif
    @endsection