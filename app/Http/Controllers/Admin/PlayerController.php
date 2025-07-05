<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $players = Player::latest()->paginate(10);
        return view('admin.players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.players.create');
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
            'sobrenome' => 'nullable|string|max:255',
            'posicao' => 'required|string|max:100',
            'numero_camisa' => 'nullable|integer|unique:players,numero_camisa|min:1|max:99',
            'nacionalidade' => 'nullable|string|max:100',
            'data_nascimento' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('players_fotos', 'public');
        }

        Player::create([
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'posicao' => $request->posicao,
            'numero_camisa' => $request->numero_camisa,
            'nacionalidade' => $request->nacionalidade,
            'data_nascimento' => $request->data_nascimento,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.players.index')->with('success', 'Jogador criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param Player $player
     * @return RedirectResponse
     */
    public function show(Player $player): RedirectResponse
    {
        return redirect()->route('admin.players.edit', $player);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Player $player
     * @return View
     */
    public function edit(Player $player): View
    {
        return view('admin.players.edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Player $player
     * @return RedirectResponse
     */
    public function update(Request $request, Player $player): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sobrenome' => 'nullable|string|max:255',
            'posicao' => 'required|string|max:100',
            'numero_camisa' => 'nullable|integer|unique:players,numero_camisa,' . $player->id . '|min:1|max:99',
            'nacionalidade' => 'nullable|string|max:100',
            'data_nascimento' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fotoPath = $player->foto;
        if ($request->hasFile('foto')) {
            if ($player->foto) {
                Storage::disk('public')->delete($player->foto);
            }
            $fotoPath = $request->file('foto')->store('players_fotos', 'public');
        } elseif ($request->input('remover_foto')) {
            if ($player->foto) {
                Storage::disk('public')->delete($player->foto);
                $fotoPath = null;
            }
        }

        $player->update([
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'posicao' => $request->posicao,
            'numero_camisa' => $request->numero_camisa,
            'nacionalidade' => $request->nacionalidade,
            'data_nascimento' => $request->data_nascimento,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.players.index')->with('success', 'Jogador atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Player $player
     * @return RedirectResponse
     */
    public function destroy(Player $player): RedirectResponse
    {
        if ($player->foto) {
            Storage::disk('public')->delete($player->foto);
        }

        $player->delete();
        return redirect()->route('admin.players.index')->with('success', 'Jogador excluído com sucesso!');
    }
}
