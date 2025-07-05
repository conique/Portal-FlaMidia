@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Criar Nova Página Estática</h2>

    <form action="{{ route('admin.pages.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título da Página</label>
            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" required placeholder="Ex: Sobre Nós">
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug (URL Amigável)</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="ex: sobre, contato, politica-de-privacidade">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Será usado na URL (ex: /contato).</small>
        </div>

        <div class="mb-3">
            <label for="conteudo" class="form-label">Conteúdo da Página</label>
            <textarea class="form-control @error('conteudo') is-invalid @enderror" id="conteudo" name="conteudo" rows="10" placeholder="Digite o conteúdo completo da página aqui...">{{ old('conteudo') }}</textarea>
            @error('conteudo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Salvar Página</button>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
