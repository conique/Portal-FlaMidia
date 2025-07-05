@extends('layouts.admin') {{-- Extende o layout do admin --}}

@section('content')
    <h2 class="mb-4">Gerenciar Notícias</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Lista de Notícias</h3>
        <a href="{{ route('admin.noticias.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nova Notícia
        </a>
    </div>

    @if ($noticias->isEmpty())
        <div class="alert alert-info" role="alert">
            Nenhuma notícia encontrada. Crie a primeira!
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Categoria</th>
                        <th>Autor</th>
                        <th>Publicado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($noticias as $noticia)
                        <tr>
                            <td>{{ $noticia->id }}</td>
                            <td>{{ $noticia->titulo }}</td>
                            <td>{{ $noticia->category->nome ?? 'N/A' }}</td> {{-- Exibe o nome da categoria --}}
                            <td>{{ $noticia->user->name ?? 'Desconhecido' }}</td> {{-- Exibe o nome do autor --}}
                            <td>{{ $noticia->published_at ? $noticia->published_at->format('d/m/Y H:i') : 'Rascunho' }}</td>
                            <td>
                                <a href="{{ route('admin.noticias.edit', $noticia->id) }}" class="btn btn-sm btn-primary me-2">Editar</a>
                                <form action="{{ route('admin.noticias.destroy', $noticia->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta notícia?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Links de Paginação --}}
        <div class="d-flex justify-content-center">
            {{ $noticias->links() }}
        </div>
    @endif
@endsection