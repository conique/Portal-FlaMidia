    @extends('layouts.admin')

    @section('content')
        <h2 class="mb-4">Editar Página: Contato</h2>

        {{-- O $page é passado do controller (firstOrCreate) --}}
        <form action="{{ route('admin.pages.contact.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="titulo" class="form-label">Título da Página</label>
                <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $page->titulo) }}" required placeholder="Ex: Fale Conosco">
                @error('titulo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- O campo slug foi removido, pois o slug é fixo 'contato' --}}
            <div class="mb-3">
                <label for="conteudo" class="form-label">Conteúdo da Página</label>
                <textarea class="form-control @error('conteudo') is-invalid @enderror" id="conteudo" name="conteudo" rows="10" placeholder="Digite o conteúdo completo da página aqui...">{{ old('conteudo', $page->conteudo) }}</textarea>
                @error('conteudo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Atualizar Página Contato</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Voltar para Dashboard</a>
            </div>
        </form>
    @endsection
    