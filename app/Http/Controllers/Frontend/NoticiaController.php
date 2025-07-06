<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the news for the frontend.
     */
    public function index(): View
    {
        $noticias = Noticia::with('category', 'user')
                           ->whereNotNull('published_at')
                           ->latest()
                           ->paginate(10);

        return view('frontend.noticias.index', compact('noticias'));
    }

    /**
     * Display the specified news item.
     */
    public function show(string $slug): View
    {
        $noticia = Noticia::where('slug', $slug)
                          ->whereNotNull('published_at')
                          ->firstOrFail();

        return view('frontend.noticias.show', compact('noticia'));
    }
}