<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $noticias = Noticia::with('category', 'user')->latest()->paginate(10);
        return view('admin.noticias.index', compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.noticias.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'imagem_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = Str::slug($request->titulo);
        $count = 0;
        while (Noticia::where('slug', $slug)->exists()) {
            $count++;
            $slug = Str::slug($request->titulo) . '-' . $count;
        }

        $imagemPath = null;
        if ($request->hasFile('imagem_principal')) {
            $imagemPath = $request->file('imagem_principal')->store('noticias_imagens', 'public');
        }

        Noticia::create([
            'titulo' => $request->titulo,
            'slug' => $slug,
            'conteudo' => $request->conteudo,
            'imagem_principal' => $imagemPath,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.noticias.index')->with('success', 'Notícia criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Noticia $noticia)
    {
        return redirect()->route('admin.noticias.edit', $noticia);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noticia $noticia)
    {
        $categories = Category::all();
        return view('admin.noticias.edit', compact('noticia', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Noticia $noticia)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'imagem_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = Str::slug($request->titulo);
        if ($slug !== $noticia->slug) {
            $count = 0;
            while (Noticia::where('slug', $slug)->where('id', '!=', $noticia->id)->exists()) {
                $count++;
                $slug = Str::slug($request->titulo) . '-' . $count;
            }
        } else {
            $slug = $noticia->slug;
        }

        $imagemPath = $noticia->imagem_principal;
        if ($request->hasFile('imagem_principal')) {
            if ($noticia->imagem_principal) {
                Storage::disk('public')->delete($noticia->imagem_principal);
            }
            $imagemPath = $request->file('imagem_principal')->store('noticias_imagens', 'public');
        } elseif ($request->input('remover_imagem')) {
             if ($noticia->imagem_principal) {
                Storage::disk('public')->delete($noticia->imagem_principal);
                $imagemPath = null;
             }
        }

        $noticia->update([
            'titulo' => $request->titulo,
            'slug' => $slug,
            'conteudo' => $request->conteudo,
            'imagem_principal' => $imagemPath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.noticias.index')->with('success', 'Notícia atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noticia $noticia)
    {
        if ($noticia->imagem_principal) {
            Storage::disk('public')->delete($noticia->imagem_principal);
        }

        $noticia->delete();
        return redirect()->route('admin.noticias.index')->with('success', 'Notícia excluída com sucesso!');
    }
}
