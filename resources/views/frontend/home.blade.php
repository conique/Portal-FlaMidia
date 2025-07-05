@extends('layouts.frontend')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="display-4">Bem-vindo ao Portal FlaMídia!</h1>
            <p class="lead">As últimas notícias do Mais Querido.</p>
            <hr class="my-4">
        </div>
    </div>

    {{-- Ajuste a margem superior desta div --}}
    <div class="row mt-4">
        <div class="col-12">
            @if ($ultimasNoticias->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                Nenhuma notícia publicada no momento.
            </div>
            @else
            <div class="row">
                @foreach ($ultimasNoticias as $noticia)
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
            @endif
        </div>
    </div>

    {{-- Botão "Ver Todas as Notícias" movido para o final --}}
    <div class="row mt-5">
        <div class="col-12 text-center">
            <a href="{{ route('noticias.index') }}" class="btn btn-primary btn-lg mt-3">Ver Todas as Notícias</a>
        </div>
    </div>
</div>
@endsection