@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Editar Notícia: {{ $noticia->titulo }}</h2>

    <form action="{{ route('admin.noticias.update', $noticia->id) }}" method="POST" enctype="multipart/form-data">
        @csrf {{-- Token CSRF para segurança --}}
        @method('PUT') {{-- Método HTTP PUT para atualização --}}

        <div class="mb-3">
            <label for="titulo" class="form-label">Título da Notícia</label>
            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $noticia->titulo) }}" required placeholder="Ex: Flamengo vence o clássico!">
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoria</label>
            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                <option value="">Selecione uma Categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $noticia->category_id) == $category->id ? 'selected' : '' }}>
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
            <textarea class="form-control @error('conteudo') is-invalid @enderror" id="conteudo" name="conteudo" rows="10" required placeholder="Digite o conteúdo completo da notícia aqui...">{{ old('conteudo', $noticia->conteudo) }}</textarea>
            @error('conteudo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="imagem_principal" class="form-label">Imagem Principal Atual</label>
            @if ($noticia->imagem_principal)
                <div class="mb-2">
                    <img src="{{ Storage::url($noticia->imagem_principal) }}" alt="Imagem Atual" class="img-thumbnail" style="max-width: 200px;">
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="remover_imagem" id="remover_imagem" value="1">
                    <label class="form-check-label" for="remover_imagem">
                        Remover imagem atual
                    </label>
                </div>
            @else
                <p class="text-muted">Nenhuma imagem principal definida.</p>
            @endif
            <label for="nova_imagem_principal" class="form-label">Nova Imagem Principal</label>
            <input type="file" class="form-control @error('imagem_principal') is-invalid @enderror" id="nova_imagem_principal" name="imagem_principal" accept="image/*">
            @error('imagem_principal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Formatos: JPG, PNG, GIF, SVG. Max: 2MB. A nova imagem substituirá a atual.</small>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Atualizar Notícia</button>
            <a href="{{ route('admin.noticias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
