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
     * Exibe o formulário de edição para a página de contato.
     * Se a página não existir, cria uma básica.
     *
     * @return View
     */
    public function editContactPage(): View
    {
        $slug = 'contato';
        $page = Page::firstOrCreate(
            ['slug' => $slug],
            ['titulo' => 'Contato', 'conteudo' => 'Entre em contato conosco...']
        );
        return view('admin.pages.edit_contact', compact('page'));
    }

    /**
     * Atualiza o conteúdo da página de contato.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateContactPage(Request $request): RedirectResponse
    {
        $slug = 'contato';
        $page = Page::where('slug', $slug)->firstOrFail();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
        ]);

        $page->update([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Página de Contato atualizada com sucesso!');
    }

    /**
     * Exibe uma página estática pelo seu slug (para o frontend).
     * Este método continua sendo usado para o frontend.
     *
     * @param string|null $slug
     * @return View
     */
    public function showPageBySlug(?string $slug = null): View
    {

        if (is_null($slug)) {
            $currentRouteName = request()->route()->getName();
            if ($currentRouteName === 'contato') {
                $slug = 'contato';
            } else {
                $slug = 'home';
            }
        }

        $page = Page::where('slug', $slug)->firstOrFail();
        return view('frontend.page_dynamic', compact('page'));
    }
}
