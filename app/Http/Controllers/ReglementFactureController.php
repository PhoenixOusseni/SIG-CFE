<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\BaseTaxable;
use Illuminate\Http\Request;
use App\Models\ReglementFacture;
use App\Models\SourcePrelevement;
use App\Http\Controllers\Controller;

class ReglementFactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = ReglementFacture::all();
        return view('pages.reglement.liste_reglement',compact('collection'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReglementFacture  $reglementFacture
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $reglement = ReglementFacture::find($id);

        return view('pages.reglement.show',compact('reglement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReglementFacture  $reglementFacture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $recettes = Recette::find($id);
        $recettes->update([
            'statut' => 'reglée',
         ]);

        $reglements = ReglementFacture::create([
            'recettes_id' => $recettes->id,
            'date' => $request->date,
            'versement' => $request->versement,
            'net' => $request->net,
            'reste' => $request->net - $request->versement,
        ]);

        if ($reglements) {
            smilify('success','Facture reglée avec succès !');
        } else {
            smilify('error','Erreur lors de la création du reglement !');
        }

        return redirect()->route('module_reglement.index');
    }

    public function print_regle_recette(string $id)
    {
        $reglements = ReglementFacture::find($id);

        return view('pages.reglement.print_reglement', compact('reglements'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReglementFacture  $reglementFacture
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReglementFacture $reglementFacture)
    {
        //
    }
}
