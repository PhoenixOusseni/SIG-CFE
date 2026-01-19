<?php

namespace App\Http\Controllers;

use App\Models\Diligence;
use App\Models\Personnel;
use App\Models\Service;
use Illuminate\Http\Request;

class DiligenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diligences = Diligence::all();
        return view('pages.diligences.index', compact('diligences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personnels = Personnel::all();
        $services = Service::all();
        return view('pages.diligences.create', compact('personnels', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $diligence = new Diligence();
        $diligence->code = $request->code;
        $diligence->designation = $request->designation;
        $diligence->taux = $request->taux;
        $diligence->contrainte = $request->contrainte;
        $diligence->personnel_id = $request->personnel_id;
        $diligence->service_id = $request->service_id;

        if ($request->hasFile('pj1')) {
            $path = $request->file('pj1')->store('uploads', 'public');
            $diligence->pj1 = $path;
        }

        if ($request->hasFile('pj2')) {
            $path = $request->file('pj2')->store('uploads', 'public');
            $diligence->pj2 = $path;
        }

        if ($request->hasFile('pj3')) {
            $path = $request->file('pj3')->store('uploads', 'public');
            $diligence->pj3 = $path;
        }

        $diligence->save();

        return redirect()->route('gestion_diligence.index')->with('success', 'Diligence ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $finds = Diligence::findOrFail($id);
        return view('pages.diligences.show', compact('finds'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $finds = Diligence::findOrFail($id);
        $personnels = Personnel::all();
        $services = Service::all();
        return view('pages.diligences.edit', compact('finds', 'personnels', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $finds = Diligence::findOrFail($id);
        $finds->code = $request->code;
        $finds->designation = $request->designation;
        $finds->taux = $request->taux;
        $finds->contrainte = $request->contrainte;
        $finds->personnel_id = $request->personnel_id;
        $finds->service_id = $request->service_id;

        if ($request->hasFile('pj1')) {
            $file1 = $request->file('pj1');
            $filename1 = time() . '_pj1_' . $file1->getClientOriginalName();
            $file1->move(public_path('uploads/diligence'), $filename1);
            $finds->pj1 = $filename1;
        }

        if ($request->hasFile('pj2')) {
            $file2 = $request->file('pj2');
            $filename2 = time() . '_pj2_' . $file2->getClientOriginalName();
            $file2->move(public_path('uploads/diligence'), $filename2);
            $finds->pj2 = $filename2;
        }

        if ($request->hasFile('pj3')) {
            $file3 = $request->file('pj3');
            $filename3 = time() . '_pj3_' . $file3->getClientOriginalName();
            $file3->move(public_path('uploads/diligence'), $filename3);
            $finds->pj3 = $filename3;
        }

        $finds->save();

        return redirect()->route('gestion_diligence.index')->with('success', 'Diligence mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $finds = Diligence::findOrFail($id);
        $finds->delete();
        return redirect()->route('gestion_diligence.index')->with('success', 'Diligence supprimée avec succès.');
    }
}
