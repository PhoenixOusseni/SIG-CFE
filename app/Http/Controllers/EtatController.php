<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\Entete;
use App\Models\Recette;
use Illuminate\Http\Request;

class EtatController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function etat_budget_depense(Request $request)
    {
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;
        $budgets_id = $request->budgets_id;

        $budget = Budget::find($budgets_id);

        $factures = $budget->FactureFournisseur()->with(['ElementFacture'])->whereDate('created_at', '>=', $date_debut)->whereDate('created_at', '<=', $date_fin)->get();

        $somme_element = 0;
        foreach ($factures as $facture) {
            $somme_element += $facture->ElementFacture->sum('montant_total');
        }

        $ecart = $budget->dotation - $somme_element;
        $pourentage = ($somme_element * 100) / $budget->dotation;

        $entetes = Entete::all();

        return view('pages.etats.etat_budget_depense', compact('factures', 'budget', 'ecart', 'pourentage', 'somme_element', 'entetes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function etat_budget_recette(Request $request)
    {
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;
        $budgets_id = $request->budgets_id;

        $budget = Budget::find($budgets_id);

        $recettes = $budget->Recette()->with(['ElementRecette'])->whereDate('created_at', '>=', $date_debut)->whereDate('created_at', '<=', $date_fin)->get();

        $somme_element = 0;
        foreach ($recettes as $recet) {
            $somme_element += $recet->ElementRecette->sum('montant');
        }

        $ecart = $budget->dotation - $somme_element;
        $pourentage = ($somme_element * 100) / $budget->dotation;

        $entetes = Entete::all();

        return view('pages.etats.etat_budget_recette', compact('recettes', 'budget', 'ecart', 'pourentage', 'somme_element', 'entetes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function etat_tous_budget(Request $request)
    {
        $budgets=Budget::with(['FactureFournisseur','FactureFournisseur.ElementFacture'])->where('type', 'Dépense')->get();
        $entetes = Entete::all();

        return view('pages.etats.etat_tous_budget_depense', compact('budgets', 'entetes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function tous_budget_recette(Request $request)
    {
        $budgets=Budget::with(['Recette','Recette.ElementRecette'])->where('type', 'Recette')->get();
        $entetes = Entete::all();

        return view('pages.etats.etat_tous_budget_recette', compact('budgets', 'entetes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function depense_recette(Request $request)
    {
        $recettes=Budget::with(['Recette'])->where('type', 'Recette')->get();
        $depenses=Budget::with(['FactureFournisseur'])->where('type', 'Dépense')->get();

        // $somme_recette = 0;
        // foreach ($recettes as $recet) {
        //     $somme_recette += $recet->ElementRecette->sum('montant');
        // }

        // $somme_fact = 0;
        // foreach ($depenses as $fact) {
        //     $somme_fact += $fact->ElementFacture->sum('montant_total');
        // }

        return view('pages.etats.depense_recette', compact('recettes', 'depenses'));
    }
}
