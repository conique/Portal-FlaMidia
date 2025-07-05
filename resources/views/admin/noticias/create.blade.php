@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Criar Nova Notícia</h2>

    <form action="{{ route('admin.noticias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf {{-- Token CSRF para segurança --}}

        <div class="mb-3">
            <label for="titulo" class="form-label">Título da Notícia</label>
            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" required placeholder="Ex: Flamengo vence o clássico!">
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoria</label>
            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                <option value="">Selecione uma Categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nome }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="conteudo" class="form-label">Conteúdo da Notícia</label>
            <textarea class="form-control @error('conteudo') is-invalid @enderror" id="conteudo" name="conteudo" rows="10" required placeholder="Digite o conteúdo completo da notícia aqui...">{{ old('conteudo') }}</textarea>
            @error('conteudo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="imagem_principal" class="form-label">Imagem Principal</label>
            <input type="file" class="form-control @error('imagem_principal') is-invalid @enderror" id="imagem_principal" name="imagem_principal" accept="image/*">
            @error('imagem_principal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Formatos: JPG, PNG, GIF, SVG. Max: 2MB.</small>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Salvar Notícia</button>
            <a href="{{ route('admin.noticias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
