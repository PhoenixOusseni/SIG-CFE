<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use App\Models\Diligence;
use App\Models\Service;
use Illuminate\Http\Request;

class CritereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criteres = Critere::all();
        return view('pages.criteres.index', compact('criteres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        $diligences = Diligence::all();
        return view('pages.criteres.create', compact('services', 'diligences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $critere = new Critere();
        $critere->code = $request->code;
        $critere->designation = $request->designation;
        $critere->taux = $request->taux;
        $critere->appreciation = $request->appreciation;
        $critere->service_id = $request->service_id;
        $critere->diligence_id = $request->diligence_id;

        if ($request->hasFile('pj1')) {
            $path = $request->file('pj1')->store('uploads', 'public');
            $critere->pj1 = $path;
        }

        if ($request->hasFile('pj2')) {
            $path = $request->file('pj2')->store('uploads', 'public');
            $critere->pj2 = $path;
        }

        if ($request->hasFile('pj3')) {
            $path = $request->file('pj3')->store('uploads', 'public');
            $critere->pj3 = $path;
        }

        $critere->save();

        return redirect()->route('gestion_critere.index')->with('success', 'Critère ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $finds = Critere::findOrFail($id);
        return view('pages.criteres.show', compact('finds'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $finds = Critere::findOrFail($id);
        $services = Service::all();
        $diligences = Diligence::all();
        return view('pages.criteres.edit', compact('finds', 'services', 'diligences'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $finds = Critere::findOrFail($id);
        $finds->code = $request->code;
        $finds->designation = $request->designation;
        $finds->taux = $request->taux;
        $finds->appreciation = $request->appreciation;
        $finds->service_id = $request->service_id;
        $finds->diligence_id = $request->diligence_id;

        if ($request->hasFile('pj1')) {
            $file1 = $request->file('pj1');
            $filename1 = time() . '_pj1_' . $file1->getClientOriginalName();
            $file1->move(public_path('uploads/critere'), $filename1);
            $finds->pj1 = $filename1;
        }

        if ($request->hasFile('pj2')) {
            $file2 = $request->file('pj2');
            $filename2 = time() . '_pj2_' . $file2->getClientOriginalName();
            $file2->move(public_path('uploads/critere'), $filename2);
            $finds->pj2 = $filename2;
        }

        if ($request->hasFile('pj3')) {
            $file3 = $request->file('pj3');
            $filename3 = time() . '_pj3_' . $file3->getClientOriginalName();
            $file3->move(public_path('uploads/critere'), $filename3);
            $finds->pj3 = $filename3;
        }

        $finds->save();

        return redirect()->route('gestion_critere.index')->with('success', 'Critère mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $finds = Critere::findOrFail($id);
        $finds->delete();

        return redirect()->route('gestion_critere.index')->with('success', 'Critère supprimé avec succès.');
    }
}
