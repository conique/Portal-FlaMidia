<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the application's home page with the latest news.
     *
     * @return View
     */
    public function index(): View
    {
        $ultimasNoticias = Noticia::with('category', 'user')
            ->whereNotNull('published_at')
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.home', compact('ultimasNoticias'));
    }
}
