<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Player; // Importe o Model Player
use Illuminate\Http\Request;
use Illuminate\View\View;

class ElencoController extends Controller
{
    /**
     * Display a listing of the players for the frontend.
     *
     * @return View
     */
    public function index(): View
    {
        $players = Player::latest()->paginate(12); // Busca todos os jogadores, paginado
        return view('frontend.elenco', compact('players'));
    }
}