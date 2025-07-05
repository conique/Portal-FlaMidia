@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Criar Novo Jogador</h2>

    <form action="{{ route('admin.players.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" required placeholder="Ex: Gabriel">
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="sobrenome" class="form-label">Sobrenome</label>
                <input type="text" class="form-control @error('sobrenome') is-invalid @enderror" id="sobrenome" name="sobrenome" value="{{ old('sobrenome') }}" placeholder="Ex: Barbosa">
                @error('sobrenome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="posicao" class="form-label">Posição</label>
                <select class="form-select @error('posicao') is-invalid @enderror" id="posicao" name="posicao" required>
                    <option value="">Selecione a Posição</option>
                    <option value="Goleiro" {{ old('posicao') == 'Goleiro' ? 'selected' : '' }}>Goleiro</option>
                    <option value="Zagueiro" {{ old('posicao') == 'Zagueiro' ? 'selected' : '' }}>Zagueiro</option>
                    <option value="Lateral" {{ old('posicao') == 'Lateral' ? 'selected' : '' }}>Lateral</option>
                    <option value="Meio-campo" {{ old('posicao') == 'Meio-campo' ? 'selected' : '' }}>Meio-campo</option>
                    <option value="Atacante" {{ old('posicao') == 'Atacante' ? 'selected' : '' }}>Atacante</option>
                </select>
                @error('posicao')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="numero_camisa" class="form-label">Número da Camisa</label>
                <input type="number" class="form-control @error('numero_camisa') is-invalid @enderror" id="numero_camisa" name="numero_camisa" value="{{ old('numero_camisa') }}" min="1" max="99" placeholder="Ex: 10">
                @error('numero_camisa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nacionalidade" class="form-label">Nacionalidade</label>
                <input type="text" class="form-control @error('nacionalidade') is-invalid @enderror" id="nacionalidade" name="nacionalidade" value="{{ old('nacionalidade') }}" placeholder="Ex: Brasileiro">
                @error('nacionalidade')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento') }}">
                @error('data_nascimento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Campo de Descrição/Biografia REMOVIDO --}}

        <div class="mb-3">
            <label for="foto" class="form-label">Foto do Jogador</label>
            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Formatos: JPG, PNG, GIF, SVG. Max: 2MB.</small>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Salvar Jogador</button>
            <a href="{{ route('admin.players.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
