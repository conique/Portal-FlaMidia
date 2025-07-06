<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Championship;
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
        $championships = Championship::orderBy('ano', 'desc')->latest()->paginate(10);
        return view('frontend.campeonatos', compact('championships'));
    }
}