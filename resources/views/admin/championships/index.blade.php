@extends('layouts.admin')

@section('content')
<h2 class="mb-4">Gerenciar Campeonatos</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Lista de Campeonatos</h3>
    <a href="{{ route('admin.championships.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Novo Campeonato
    </a>
</div>

@if ($championships->isEmpty())
<div class="alert alert-info" role="alert">
    Nenhum campeonato encontrado.
</div>
@else
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Logo</th>
                <th>Nome</th>
                <th>Ano</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($championships as $championship)
            <tr>
                <td>{{ $championship->id }}</td>
                <td>
                    @if ($championship->logo)
                    <img src="{{ Storage::url($championship->logo) }}" alt="{{ $championship->nome }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: contain;">
                    @else
                    <img src="https://placehold.co/50x50/cccccc/ffffff?text=NL" alt="Sem Logo" class="img-thumbnail">
                    @endif
                </td>
                <td>{{ $championship->nome }}</td>
                <td>{{ $championship->ano ?? 'N/A' }}</td>
                <td>{{ $championship->status ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('admin.championships.edit', $championship->id) }}" class="btn btn-sm btn-primary me-2">Editar</a>
                    <form action="{{ route('admin.championships.destroy', $championship->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este campeonato?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Links de Paginação --}}
<div class="d-flex justify-content-center">
    {{ $championships->links() }}
</div>
@endif
@endsection