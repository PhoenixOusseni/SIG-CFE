<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\Service;

use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personnels = Personnel::all();
        return view('pages.personnels.index', compact('personnels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('pages.personnels.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $personnel = new Personnel();
        $personnel->nom = $request->nom;
        $personnel->prenom = $request->prenom;
        $personnel->email = $request->email;
        $personnel->telephone = $request->telephone;
        $personnel->adresse = $request->adresse;
        $personnel->niveau_cadre = $request->niveau_cadre;
        $personnel->poste = $request->poste;
        $personnel->service_id = $request->service_id;

        if ($request->hasFile('pj1')) {
            $file1 = $request->file('pj1');
            $filename1 = time() . '_pj1_' . $file1->getClientOriginalName();
            $file1->move(public_path('uploads/personnels'), $filename1);
            $personnel->pj1 = $filename1;
        }

        if ($request->hasFile('pj2')) {
            $file2 = $request->file('pj2');
            $filename2 = time() . '_pj2_' . $file2->getClientOriginalName();
            $file2->move(public_path('uploads/personnels'), $filename2);
            $personnel->pj2 = $filename2;
        }

        if ($request->hasFile('pj3')) {
            $file3 = $request->file('pj3');
            $filename3 = time() . '_pj3_' . $file3->getClientOriginalName();
            $file3->move(public_path('uploads/personnels'), $filename3);
            $personnel->pj3 = $filename3;
        }

        $personnel->save();

        return redirect()->route('gestion_personnel.index')->with('success', 'Personnel ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $finds = Personnel::findOrFail($id);
        return view('pages.personnels.show', compact('finds'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $finds = Personnel::findOrFail($id);
        $services = Service::all();
        return view('pages.personnels.edit', compact('finds', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $personnel = Personnel::findOrFail($id);
        $personnel->nom = $request->nom;
        $personnel->prenom = $request->prenom;
        $personnel->email = $request->email;
        $personnel->telephone = $request->telephone;
        $personnel->adresse = $request->adresse;
        $personnel->niveau_cadre = $request->niveau_cadre;
        $personnel->poste = $request->poste;
        $personnel->service_id = $request->service_id;

        if ($request->hasFile('pj1')) {
            $path = $request->file('pj1')->store('uploads', 'public');
            $personnel->pj1 = $path;
        }

        if ($request->hasFile('pj2')) {
            $path = $request->file('pj2')->store('uploads', 'public');
            $personnel->pj2 = $path;
        }

        if ($request->hasFile('pj3')) {
            $path = $request->file('pj3')->store('uploads', 'public');
            $personnel->pj3 = $path;
        }

        $personnel->save();

        return redirect()->route('gestion_personnel.index')->with('success', 'Personnel mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $personnel = Personnel::findOrFail($id);
        $personnel->delete();

        return redirect()->route('gestion_personnel.index')->with('success', 'Personnel supprimé avec succès.');
    }
}
