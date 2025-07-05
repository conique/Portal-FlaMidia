@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Gerenciar Categorias</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Lista de Categorias</h3>
        <a href="{{ route('admin.categorias.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nova Categoria
        </a>
    </div>

    @if ($categories->isEmpty())
        <div class="alert alert-info" role="alert">
            Nenhuma categoria encontrada.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Slug</th>
                        <th>Notícias Associadas</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->nome }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->noticias->count() }}</td> {{-- Conta notícias associadas --}}
                            <td>
                                <a href="{{ route('admin.categorias.edit', $category->id) }}" class="btn btn-sm btn-primary me-2">Editar</a>
                                <form action="{{ route('admin.categorias.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta categoria? Isso pode afetar notícias associadas.')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Links de Paginação --}}
        <div class="d-flex justify-content-center">
            {{ $categories->links() }}
        </div>
    @endif
@endsection
