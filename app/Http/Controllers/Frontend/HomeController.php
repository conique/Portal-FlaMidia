<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Noticia; // Importe o Model Noticia
use Illuminate\Http\Request;
use Illuminate\View\View; // Para tipagem de retorno

class HomeController extends Controller
{
    /**
     * Display the application's home page with the latest news.
     *
     * @return View
     */
    public function index(): View
    {
        // Busca as 5 últimas notícias publicadas
        $ultimasNoticias = Noticia::with('category', 'user')
            ->whereNotNull('published_at') // Apenas notícias publicadas
            ->latest() // Ordena pelas mais recentes
            ->take(5) // Pega apenas as 5 primeiras
            ->get(); // Executa a consulta

        return view('frontend.home', compact('ultimasNoticias'));
    }
}
