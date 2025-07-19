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
use App\Http\Controllers\Frontend\FrontendChampionshipController;
use App\Http\Controllers\Frontend\ElencoController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/noticias', [NoticiaController::class, 'index'])->name('noticias.index');
Route::get('/noticias/{slug}', [NoticiaController::class, 'show'])->name('noticias.show');

Route::get('/elenco', [ElencoController::class, 'index'])->name('elenco');
Route::get('/campeonatos', [FrontendChampionshipController::class, 'index'])->name('campeonatos');
Route::get('/contato/{slug?}', [AdminPageController::class, 'showPageBySlug'])->name('contato');

// ÁREA ADMINISTRATIVA
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('noticias', AdminNoticiaController::class);
    Route::resource('categorias', AdminCategoriaController::class);
    Route::resource('players', AdminPlayerController::class);
    Route::resource('championships', AdminChampionshipController::class);
    Route::get('/pages/contact/edit', [AdminPageController::class, 'editContactPage'])->name('pages.contact.edit');
    Route::put('/pages/contact/update', [AdminPageController::class, 'updateContactPage'])->name('pages.contact.update');

});

// ROTAS DE AUTENTICAÇÃO
require __DIR__.'/auth.php';

// REDIRECIONAMENTO
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
