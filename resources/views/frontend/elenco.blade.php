{{-- resources/views/frontend/elenco.blade.php --}}
@extends('layouts.frontend')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Elenco do Flamengo</h1>

        <p class="lead text-center">Conheça os craques do Mais Querido que brilham nos gramados!</p>

        @if ($players->isEmpty())
            <div class="alert alert-info text-center mt-4" role="alert">
                Nenhum jogador encontrado no momento.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
                @foreach ($players as $player)
                    <div class="col">
                        <div class="card h-100 text-center">
                            @if ($player->foto)
                                <img src="{{ Storage::url($player->foto) }}" class="card-img-top mx-auto mt-3 rounded-circle" alt="{{ $player->nome }} {{ $player->sobrenome }}" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <img src="https://placehold.co/150x150/cccccc/ffffff?text={{ substr($player->nome, 0, 1) }}{{ substr($player->sobrenome, 0, 1) }}" class="card-img-top mx-auto mt-3 rounded-circle" alt="Sem Foto" style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $player->nome }} {{ $player->sobrenome }}</h5>
                                <p class="card-text">Posição: {{ $player->posicao }}</p>
                                @if ($player->numero_camisa)
                                    <span class="badge bg-danger">Camisa {{ $player->numero_camisa }}</span>
                                @endif
                                @if ($player->nacionalidade)
                                    <p class="card-text mt-2"><small class="text-muted">Nacionalidade: {{ $player->nacionalidade }}</small></p>
                                @endif
                                @if ($player->descricao)
                                    <p class="card-text mt-2">{{ Str::limit(strip_tags($player->descricao), 80) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Links de Paginação --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $players->links() }}
            </div>
        @endif
    </div>
@endsection
