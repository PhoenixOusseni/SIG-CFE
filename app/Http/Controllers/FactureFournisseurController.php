<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Entete;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\ElementFacture;
use App\Models\FactureFournisseur;
use App\Http\Controllers\Controller;

class FactureFournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = FactureFournisseur::where('statut', 'en attente')->get();
        $budgets = Budget::where('type', 'Dépense')->get();
        $fournisseurs = Fournisseur::all();

        return view('pages.facure_fournisseur.index',compact('collection', 'budgets', 'fournisseurs'));
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
        $fact = FactureFournisseur::create([
            'date' => $request->date,
            'statut' => $request->statut,
            'tva' => $request->tva,
            'objet' => $request->objet,
            'fournisseurs_id' => $request->fournisseurs_id,
            'budgets_id' => $request->budgets_id,
            'users_id' => $request->users_id,
            'signataires_id' => $request->signataires_id,
         ]);

        smilify('success','Facture fournisseur ajoutée avec succès !');
        return redirect("module_facture_fournisseur/".$fact->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_facture_element(Request $request)
    {
        ElementFacture::create([
            'designation' => $request->designation,
            'quantite' => $request->quantite,
            'prix_unitaire' => $request->prix_unitaire,
            'facture_fournisseurs_id' => $request->facture_fournisseurs_id,
         ]);

        smilify('success','Element ajouté à la facture avec succès !');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FactureFournisseur  $factureFournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $factures = FactureFournisseur::find($id);
        $elements = ElementFacture::where('facture_fournisseurs_id', '=', $id)->get();

        $budgets = Budget::where('type', 'Dépense')->get();
        $fournisseurs = Fournisseur::all();

        $tota_ret = $factures->total_retenu;

        $total_ht = $elements->sum('montant_total') - $factures->total_retenu;

        $total_ttc = $elements->sum('montant_total') + ($elements->sum('montant_total') * $factures->tva / 100) - $factures->total_retenu;

        return view('pages.facure_fournisseur.show',compact('factures', 'elements', 'budgets', 'fournisseurs', 'total_ht', 'total_ttc', 'tota_ret'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\facure_fournisseur  $facure_fournisseur
     * @return \Illuminate\Http\Response
     */
    public function valider()
    {
        $collection = FactureFournisseur::where('statut', 'en attente')->get();

        return view('pages.facure_fournisseur.validation',compact('collection'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\facure_fournisseur  $facure_fournisseur
     * @return \Illuminate\Http\Response
     */
    public function en_reglement()
    {
        $collection = FactureFournisseur::where('statut', 'valide')->get();

        return view('pages.facure_fournisseur.en_reglement',compact('collection'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\facure_fournisseur  $facure_fournisseur
     * @return \Illuminate\Http\Response
     */
    public function reglement_facture()
    {
        $collection = FactureFournisseur::where('statut', 'en reglement')->get();

        return view('pages.facure_fournisseur.reglement',compact('collection'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FactureFournisseur  $FactureFournisseur
     * @return \Illuminate\Http\Response
     */
    public function show_reglement_fact(string $id)
    {
        $factures = FactureFournisseur::find($id);
        $elements = ElementFacture::where('facture_fournisseurs_id', '=', $id)->get();
        $total = $elements->sum('montant_total');

        $tota_ret = $factures->total_retenu;

        $total_ht = $elements->sum('montant_total') - $factures->total_retenu;

        $total_ttc = $elements->sum('montant_total') + ($elements->sum('montant_total') * $factures->tva / 100) - $factures->total_retenu;

        return view('pages.reglement_facture.reglement',compact('factures', 'elements', 'total', 'total_ttc', 'total_ht'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FactureFournisseur  $factureFournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(FactureFournisseur $factureFournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FactureFournisseur  $factureFournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FactureFournisseur $factureFournisseur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FactureFournisseur  $recette
     * @return \Illuminate\Http\Response
     */
    public function validation(string $id)
    {
        $fact = FactureFournisseur::find($id);
        $fact->update([
            'statut' => 'valide',
        ]);

        smilify('success','Facture fournisseur validée avec succès !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FactureFournisseur  $recette
     * @return \Illuminate\Http\Response
     */
    public function reglement(Request $request, string $id)
    {
        $fact = FactureFournisseur::find($id);
        $elements = ElementFacture::where('facture_fournisseurs_id', '=', $id)->get();
        $total = $elements->sum('montant_total');
        $fact->update([
            'statut' => 'en reglement',
            'retenu_bic' => ($total * $request->retenu_bic) / 100,
            'retenu_arcop' => $request->retenu_arcop,
            'penalite' => $request->penalite,

            'total_retenu' => $request->retenu_arcop + $request->penalite,
        ]);

        smilify('success','Facture fournisseur mise en reglement avec succès !');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_facture()
    {
        $collection = FactureFournisseur::all();
        $budgets = Budget::where('type', 'Dépense')->get();
        $fournisseurs = Fournisseur::all();

        return view('pages.facure_fournisseur.liste',compact('collection', 'budgets', 'fournisseurs'));
    }

    public function entente_facture()
    {
        $collection = FactureFournisseur::where('statut', 'en attente')->get();
        $budgets = Budget::where('type', 'Dépense')->get();
        $fournisseurs = Fournisseur::all();

        return view('pages.facure_fournisseur.liste',compact('collection', 'budgets', 'fournisseurs'));
    }

    public function valide_facture()
    {
        $collection = FactureFournisseur::where('statut', 'valide')->get();
        $budgets = Budget::where('type', 'Dépense')->get();
        $fournisseurs = Fournisseur::all();

        return view('pages.facure_fournisseur.liste',compact('collection', 'budgets', 'fournisseurs'));
    }

    public function reglem_fact()
    {
        $collection = FactureFournisseur::where('statut', 'en reglement')->get();
        $budgets = Budget::where('type', 'Dépense')->get();
        $fournisseurs = Fournisseur::all();

        return view('pages.facure_fournisseur.liste',compact('collection', 'budgets', 'fournisseurs'));
    }

    public function regle_fact()
    {
        $collection = FactureFournisseur::where('statut', 'reglée')->get();
        $budgets = Budget::where('type', 'Dépense')->get();
        $fournisseurs = Fournisseur::all();

        return view('pages.facure_fournisseur.liste',compact('collection', 'budgets', 'fournisseurs'));
    }

    public function print_facture(string $id)
    {
        $factures = FactureFournisseur::find($id);
        $entetes = Entete::all();

        return view('pages.facure_fournisseur.print_facture', compact('factures', 'entetes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FactureFournisseur  $factureFournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $fact = FactureFournisseur::find($id);
        $fact->delete();

        smilify('error', 'La facture a été supprimer avec success !');
        return redirect()->route('all_recette');
    }

    public function destroy_element(string $id)
    {
        $elem = ElementFacture::find($id);
        $elem->delete();

        smilify('error', 'La ligne a été retirée de la facture !');
        return redirect()->back();
    }
}
