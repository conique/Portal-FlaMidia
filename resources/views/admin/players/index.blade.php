@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Gerenciar Jogadores</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Lista de Jogadores</h3>
        <a href="{{ route('admin.players.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Novo Jogador
        </a>
    </div>

    @if ($players->isEmpty())
        <div class="alert alert-info" role="alert">
            Nenhum jogador encontrado.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Posição</th>
                        <th>Camisa</th>
                        <th>Nacionalidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($players as $player)
                        <tr>
                            <td>{{ $player->id }}</td>
                            <td>
                                @if ($player->foto)
                                    <img src="{{ Storage::url($player->foto) }}" alt="{{ $player->nome }}" class="img-thumbnail rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <img src="https://placehold.co/50x50/cccccc/ffffff?text=NP" alt="Sem Foto" class="img-thumbnail rounded-circle">
                                @endif
                            </td>
                            <td>{{ $player->nome }} {{ $player->sobrenome }}</td>
                            <td>{{ $player->posicao }}</td>
                            <td>{{ $player->numero_camisa ?? 'N/A' }}</td>
                            <td>{{ $player->nacionalidade ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.players.edit', $player->id) }}" class="btn btn-sm btn-primary me-2">Editar</a>
                                <form action="{{ route('admin.players.destroy', $player->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este jogador?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Links de Paginação --}}
        <div class="d-flex justify-content-center">
            {{ $players->links() }}
        </div>
    @endif
@endsection
