<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of agendas.
     */
    public function index()
    {
        $agendas = Agenda::published()
            ->upcoming()
            ->paginate(10);

        return view('frontend.agendas.index', compact('agendas'));
    }

    /**
     * Display the specified agenda.
     */
    public function show($slug)
    {
        $agenda = Agenda::where('slug', $slug)
            ->published()
            ->firstOrFail();

        return view('frontend.agendas.show', compact('agenda'));
    }
}