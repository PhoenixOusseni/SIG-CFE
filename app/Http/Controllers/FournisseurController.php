<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Fournisseur::all();

        return view('pages.fournisseur.index',compact('collection'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Fournisseur::create([
            'libelle' => $request->libelle,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'ifu' => $request->ifu,
            'rccm' => $request->rccm,
        ]);

        smilify('success','Fournisseur ajouté avec succès !');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, String $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->update([
            'libelle' => $request->libelle,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'ifu' => $request->ifu,
            'rccm' => $request->rccm,
        ]);

        smilify('success','Fournisseur mis à jour avec succès !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();

        smilify('success','Fournisseur supprimé avec succès !');
        return redirect()->back();
    }
}
