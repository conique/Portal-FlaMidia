@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Criar Novo Campeonato</h2>

    <form action="{{ route('admin.championships.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Campeonato</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" required placeholder="Ex: Campeonato Brasileiro Série A">
            @error('nome')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="ano" class="form-label">Ano</label>
                <input type="text" class="form-control @error('ano') is-invalid @enderror" id="ano" name="ano" value="{{ old('ano', date('Y')) }}" placeholder="Ex: 2025">
                @error('ano')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                    <option value="">Selecione o Status</option>
                    <option value="Em Andamento" {{ old('status') == 'Em Andamento' ? 'selected' : '' }}>Em Andamento</option>
                    <option value="Finalizado" {{ old('status') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                    <option value="Próximos Jogos" {{ old('status') == 'Próximos Jogos' ? 'selected' : '' }}>Próximos Jogos</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="5" placeholder="Breve descrição sobre o campeonato...">{{ old('descricao') }}</textarea>
            @error('descricao')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">Logo do Campeonato</label>
            <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
            @error('logo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Formatos: JPG, PNG, GIF, SVG. Max: 2MB.</small>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Salvar Campeonato</button>
            <a href="{{ route('admin.championships.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
