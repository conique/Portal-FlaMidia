{{-- resources/views/frontend/contato.blade.php --}}
@extends('layouts.frontend')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Entre em Contato com o Portal FlaMídia</h1>

        <p class="lead text-center">Sua opinião é muito importante para nós!</p>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card p-4">
                    <form> {{-- Este formulário é apenas de demonstração, não envia e-mail --}}
                        <div class="mb-3">
                            <label for="nome" class="form-label">Seu Nome</label>
                            <input type="text" class="form-control" id="nome" placeholder="Seu Nome Completo" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Seu Email</label>
                            <input type="email" class="form-control" id="email" placeholder="nome@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="assunto" class="form-label">Assunto</label>
                            <input type="text" class="form-control" id="assunto" placeholder="Assunto da mensagem" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensagem" class="form-label">Mensagem</label>
                            <textarea class="form-control" id="mensagem" rows="5" placeholder="Sua mensagem..." required></textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger">Enviar Mensagem</button>
                        </div>
                    </form>
                </div>
                <div class="text-center mt-4">
                    <p class="text-muted">
                        <i class="fas fa-envelope"></i> E-mail: contato@flamidia.com.br <br>
                        <i class="fas fa-phone"></i> Telefone: (21) 98765-4321 (Fictício)
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection