@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Gerenciar Páginas Estáticas</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Lista de Páginas</h3>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nova Página
        </a>
    </div>

    @if ($pages->isEmpty())
        <div class="alert alert-info" role="alert">
            Nenhuma página encontrada.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Slug</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{ $page->id }}</td>
                            <td>{{ $page->titulo }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>
                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-primary me-2">Editar</a>
                                <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta página?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Links de Paginação --}}
        <div class="d-flex justify-content-center">
            {{ $pages->links() }}
        </div>
    @endif
@endsection
