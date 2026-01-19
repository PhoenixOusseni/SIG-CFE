<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FactureFournisseur;
use App\Models\ReglementFournisseur;
use Illuminate\Http\Request;

class ReglementFournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = ReglementFournisseur::all();
        return view('pages.reglement_facture.liste_reglement',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reglement = ReglementFournisseur::find($id);

        return view('pages.reglement_facture.show',compact('reglement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fact = FactureFournisseur::find($id);
        $fact->update([
            'statut' => 'reglée',
         ]);

        $reglements = ReglementFournisseur::create([
            'date' => $request->date,
            'net' => $request->net,
            'versement' => $request->versement,

            'reste' => $request->net - $request->versement,
            'mode_reglement' => $request->mode_reglement,
            'facture_fournisseurs_id' => $id,
         ]);
         if ($reglements) {
            smilify('success','Facture reglée avec succès !');
        } else {
            smilify('error','Erreur lors de la création du reglement !');
        }

        return redirect()->route('module_reglement_fournisseur.index');
    }

    public function print_regle_facture(string $id)
    {
        $reglements = ReglementFournisseur::find($id);

        return view('pages.reglement_facture.print_reglement', compact('reglements'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
