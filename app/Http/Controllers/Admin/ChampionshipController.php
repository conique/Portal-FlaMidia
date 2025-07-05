<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Championship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ChampionshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $championships = Championship::latest()->paginate(10);
        return view('admin.championships.index', compact('championships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.championships.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'ano' => 'nullable|string|max:4',
            'status' => 'nullable|string|max:50',
            'descricao' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('championships_logos', 'public');
        }

        Championship::create([
            'nome' => $request->nome,
            'ano' => $request->ano,
            'status' => $request->status,
            'descricao' => $request->descricao,
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.championships.index')->with('success', 'Campeonato criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param Championship $championship
     * @return RedirectResponse
     */
    public function show(Championship $championship): RedirectResponse
    {
        return redirect()->route('admin.championships.edit', $championship);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Championship $championship
     * @return View
     */
    public function edit(Championship $championship): View
    {
        return view('admin.championships.edit', compact('championship'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Championship $championship
     * @return RedirectResponse
     */
    public function update(Request $request, Championship $championship): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'ano' => 'nullable|string|max:4',
            'status' => 'nullable|string|max:50',
            'descricao' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $logoPath = $championship->logo;
        if ($request->hasFile('logo')) {
            if ($championship->logo) {
                Storage::disk('public')->delete($championship->logo);
            }
            $logoPath = $request->file('logo')->store('championships_logos', 'public');
        } elseif ($request->input('remover_logo')) {
            if ($championship->logo) {
                Storage::disk('public')->delete($championship->logo);
                $logoPath = null;
            }
        }

        $championship->update([
            'nome' => $request->nome,
            'ano' => $request->ano,
            'status' => $request->status,
            'descricao' => $request->descricao,
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.championships.index')->with('success', 'Campeonato atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Championship $championship
     * @return RedirectResponse
     */
    public function destroy(Championship $championship): RedirectResponse
    {
        if ($championship->logo) {
            Storage::disk('public')->delete($championship->logo);
        }

        $championship->delete();
        return redirect()->route('admin.championships.index')->with('success', 'Campeonato excluído com sucesso!');
    }
}
