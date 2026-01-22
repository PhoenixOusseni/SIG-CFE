<?php

namespace App\Http\Controllers;

use App\Models\Traitement;
use App\Models\Critere;
use App\Models\Service;
use Illuminate\Http\Request;

class TraitementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $traitements = Traitement::all();
        return view('pages.traitement.index', compact('traitements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $criteres = Critere::all();
        $services = Service::all();
        return view('pages.traitement.create', compact('criteres', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date',
            'designation' => 'nullable|string|max:255',
            'commentaire' => 'nullable|string',
            'code' => 'nullable|string|max:255',

            'service_id' => 'nullable|exists:services,id',
            'critere_id' => 'nullable|exists:criteres,id',
        ]);

        Traitement::create($request->all());

        return redirect()->route('gestion_traitement.index')
            ->with('success', 'Traitement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $finds = Traitement::findOrFail($id);
        return view('pages.traitement.show', compact('finds'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $finds = Traitement::findOrFail($id);
        $criteres = Critere::all();
        $services = Service::all();
        return view('pages.traitement.edit', compact('finds', 'criteres', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $finds = Traitement::findOrFail($id);

        $request->validate([
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date',
            'designation' => 'nullable|string|max:255',
            'commentaire' => 'nullable|string',
            'code' => 'nullable|string|max:255',

            'service_id' => 'nullable|exists:services,id',
            'critere_id' => 'nullable|exists:criteres,id',
        ]);

        $finds->update($request->all());

        return redirect()->route('gestion_traitement.index')
            ->with('success', 'Traitement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $finds = Traitement::findOrFail($id);
        $finds->delete();

        return redirect()->route('gestion_traitement.index')
            ->with('success', 'Traitement supprimé avec succès.');
    }
}
