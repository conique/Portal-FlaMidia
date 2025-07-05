{{-- resources/views/frontend/page_dynamic.blade.php --}}
@extends('layouts.frontend')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <article class="card p-4">
                    <h1 class="mb-3">{{ $page->titulo }}</h1>
                    <div class="page-content">
                        {!! $page->conteudo !!} {{-- Renderiza o HTML do conteúdo --}}
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection