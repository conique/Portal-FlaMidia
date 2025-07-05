<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {

        $categories = Category::latest()->paginate(10);
        return view('admin.categorias.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:categories,nome',
        ]);

        $slug = Str::slug($request->nome);
        $count = 0;
        while (Category::where('slug', $slug)->exists()) {
            $count++;
            $slug = Str::slug($request->nome) . '-' . $count;
        }

        Category::create([
            'nome' => $request->nome,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return redirect()->route('admin.categorias.edit', $category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categorias.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:categories,nome,' . $category->id,
        ]);

        $slug = Str::slug($request->nome);
        if ($slug !== $category->slug) {
            $count = 0;
            while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $count++;
                $slug = Str::slug($request->nome) . '-' . $count;
            }
        } else {
            $slug = $category->slug;
        }

        $category->update([
            'nome' => $request->nome,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->noticias()->count() > 0) {
            return redirect()->route('admin.categorias.index')->with('error', 'Não é possível excluir a categoria pois há notícias associadas a ela.');
        }

        $category->delete();
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
