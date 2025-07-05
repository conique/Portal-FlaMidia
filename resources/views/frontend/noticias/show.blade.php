@extends('layouts.frontend')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <article class="card p-4">
                    <h1 class="mb-3">{{ $noticia->titulo }}</h1>

                    <p class="text-muted small">
                        Publicado em {{ $noticia->published_at ? $noticia->published_at->format('d/m/Y H:i') : 'Data Indefinida' }}
                        por {{ $noticia->user->name ?? 'Autor Desconhecido' }}
                        em <span class="badge bg-secondary">{{ $noticia->category->nome ?? 'Sem Categoria' }}</span>
                    </p>

                    @if ($noticia->imagem_principal)
                        <img src="{{ Storage::url($noticia->imagem_principal) }}" class="img-fluid rounded mb-4" alt="{{ $noticia->titulo }}">
                    @endif

                    <div class="noticia-conteudo">
                        {!! $noticia->conteudo !!} {{-- Use {!! !!} para renderizar HTML (cuidado com XSS em produção) --}}
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('noticias.index') }}" class="btn btn-outline-danger">Voltar para Notícias</a>
                        {{-- Você pode adicionar links para notícias anteriores/próximas aqui --}}
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection