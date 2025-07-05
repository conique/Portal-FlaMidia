<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Championship; // Importe o Model Championship
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendChampionshipController extends Controller
{
    /**
     * Display a listing of the championships for the frontend.
     *
     * @return View
     */
    public function index(): View
    {
        $championships = Championship::latest()->paginate(10); // Busca todos os campeonatos, paginado
        return view('frontend.campeonatos', compact('championships')); // Passa a variável 'championships' para a view
    }
}