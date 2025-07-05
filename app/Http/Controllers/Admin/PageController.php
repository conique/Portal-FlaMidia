<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    /**
     * Exibe uma listagem do recurso.
     *
     * @return View
     */
    public function index(): View
    {
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Mostra o formulário para criar um novo recurso.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.pages.create');
    }

    /**
     * Armazena um recurso recém-criado no armazenamento.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'slug' => 'required|string|unique:pages,slug|max:255', // Slug deve ser único
        ]);

        // Se o slug não for fornecido, gere a partir do título
        $slug = Str::slug($request->slug ?: $request->titulo);
        $count = 0;
        while (Page::where('slug', $slug)->exists()) {
            $count++;
            $slug = Str::slug($request->slug ?: $request->titulo) . '-' . $count;
        }

        Page::create([
            'titulo' => $request->titulo,
            'slug' => $slug,
            'conteudo' => $request->conteudo,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Página criada com sucesso!');
    }

    /**
     * Exibe o recurso especificado.
     *
     * @param Page $page
     * @return RedirectResponse
     */
    public function show(Page $page): RedirectResponse
    {
        return redirect()->route('admin.pages.edit', $page);
    }

    /**
     * Mostra o formulário para editar o recurso especificado.
     *
     * @param Page $page
     * @return View
     */
    public function edit(Page $page): View
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Atualiza o recurso especificado no armazenamento.
     *
     * @param Request $request
     * @param Page $page
     * @return RedirectResponse
     */
    public function update(Request $request, Page $page): RedirectResponse
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'slug' => 'required|string|unique:pages,slug,' . $page->id . '|max:255',
        ]);

        $slug = Str::slug($request->slug ?: $request->titulo);
        if ($slug !== $page->slug) {
            $count = 0;
            while (Page::where('slug', $slug)->where('id', '!=', $page->id)->exists()) {
                $count++;
                $slug = Str::slug($request->slug ?: $request->titulo) . '-' . $count;
            }
        } else {
            $slug = $page->slug;
        }

        $page->update([
            'titulo' => $request->titulo,
            'slug' => $slug,
            'conteudo' => $request->conteudo,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Página atualizada com sucesso!');
    }

    /**
     * Remove o recurso especificado do armazenamento.
     *
     * @param Page $page
     * @return RedirectResponse
     */
    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Página excluída com sucesso!');
    }

    /**
     * Exibe uma página estática pelo seu slug (para o frontend).
     *
     * @param string|null $slug
     * @return View
     */
    public function showPageBySlug(?string $slug = null): View
    {
        // Se nenhum slug for fornecido, use 'contato' como padrão
        // Ou você pode redirecionar para uma página de erro ou listar todas as páginas
        $slug = $slug ?? 'contato'; // Define 'contato' como padrão se slug for null

        $page = Page::where('slug', $slug)->firstOrFail(); // Busca a página pelo slug ou falha (404)
        return view('frontend.page_dynamic', compact('page'));
    }
}
