<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\NoticiaController as AdminNoticiaController;
use App\Http\Controllers\Admin\CategoriaController as AdminCategoriaController;
use App\Http\Controllers\Admin\PlayerController as AdminPlayerController;
use App\Http\Controllers\Admin\ChampionshipController as AdminChampionshipController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Frontend\NoticiaController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FrontendChampionshipController; // <<< ALTERADO PARA FrontendChampionshipController
use App\Http\Controllers\Frontend\ElencoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========================================================================
// ROTAS DO FRONTEND (ÁREA PÚBLICA DO SITE)
// ========================================================================

// Rota da Página Inicial (Home)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas para Notícias do Frontend
Route::get('/noticias', [NoticiaController::class, 'index'])->name('noticias.index');
Route::get('/noticias/{slug}', [NoticiaController::class, 'show'])->name('noticias.show');

// Rotas para Páginas Estáticas do Frontend
Route::get('/elenco', [ElencoController::class, 'index'])->name('elenco');

// Rota dinâmica para campeonatos - USANDO FrontendChampionshipController
Route::get('/campeonatos', [FrontendChampionshipController::class, 'index'])->name('campeonatos');

// Rota para a página "Contato" (URL limpa)
Route::get('/contato/{slug?}', [AdminPageController::class, 'showPageBySlug'])->name('contato');

// Rota para a página "Extras" (URL limpa) - Se você ainda quer manter, caso contrário, remova
Route::get('/extras/{slug?}', [AdminPageController::class, 'showPageBySlug'])->name('extras');

// Rota genérica para outras páginas dinâmicas (se você tiver mais além de 'contato' e 'extras')
// Route::get('/pagina/{slug}', [AdminPageController::class, 'showPageBySlug'])->name('pagina.show');


// ========================================================================
// ROTAS DE AUTENTICAÇÃO DO BREEZE
// ========================================================================
require __DIR__.'/auth.php';


// ========================================================================
// ROTAS DA ÁREA ADMINISTRATIVA (PROTEGIDAS POR AUTENTICAÇÃO)
// ========================================================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard do Admin
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Rotas de Recurso para Gerenciamento de Notícias no Admin (CRUD)
    Route::resource('noticias', AdminNoticiaController::class);

    // Rotas de Recurso para Gerenciamento de Categorias no Admin (CRUD)
    Route::resource('categorias', AdminCategoriaController::class);

    // Rotas de Recurso para Gerenciamento de Jogadores no Admin (CRUD)
    Route::resource('players', AdminPlayerController::class);

    // Rotas de Recurso para Gerenciamento de Campeonatos no Admin (CRUD)
    Route::resource('championships', AdminChampionshipController::class);

    // ROTAS ESPECÍFICAS PARA EDIÇÃO DA PÁGINA DE CONTATO (NÃO MAIS UM RESOURCE COMPLETO)
    Route::get('/pages/contact/edit', [AdminPageController::class, 'editContactPage'])->name('pages.contact.edit');
    Route::put('/pages/contact/update', [AdminPageController::class, 'updateContactPage'])->name('pages.contact.update');
    // A rota Route::resource('pages', AdminPageController::class); foi removida.
});


// ========================================================================
// REDIRECIONAMENTO PÓS-LOGIN (DO BREEZE)
// ========================================================================
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
