{{-- resources/views/frontend/campeonatos.blade.php --}}
@extends('layouts.frontend')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Campeonatos do Flamengo</h1>

        <p class="lead text-center">Acompanhe a trajetória do Flamengo nas principais competições!</p>

        @if ($championships->isEmpty())
            <div class="alert alert-info text-center mt-4" role="alert">
                Nenhum campeonato encontrado no momento.
            </div>
        @else
            <div class="table-responsive mt-4">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Nome</th>
                            <th>Ano</th>
                            <th>Status</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($championships as $championship)
                            <tr>
                                <td>
                                    @if ($championship->logo)
                                        <img src="{{ Storage::url($championship->logo) }}" alt="{{ $championship->nome }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: contain;">
                                    @else
                                        <img src="https://placehold.co/60x60/cccccc/ffffff?text=NL" alt="Sem Logo" class="img-thumbnail">
                                    @endif
                                </td>
                                <td>{{ $championship->nome }}</td>
                                <td>{{ $championship->ano ?? 'N/A' }}</td>
                                <td><span class="badge bg-primary">{{ $championship->status ?? 'N/A' }}</span></td>
                                <td>{{ Str::limit(strip_tags($championship->descricao), 150) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Links de Paginação --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $championships->links() }}
            </div>
        @endif
    </div>
@endsection
