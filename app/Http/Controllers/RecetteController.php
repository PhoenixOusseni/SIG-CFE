<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Entete;
use App\Models\Recette;
use App\Models\BaseTaxable;
use App\Models\Contribuable;
use Illuminate\Http\Request;
use App\Models\ElementRecette;
use App\Models\SourcePrelevement;
use App\Http\Controllers\Controller;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Recette::where('statut', 'en attente')->get();
        $budgets = Budget::where('type', 'Recette')->get();
        $contribuables = Contribuable::all();
        $bases = BaseTaxable::all();
        $sources = SourcePrelevement::all();

        return view('pages.recette.index', compact('collection', 'budgets', 'contribuables', 'bases', 'sources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_recette()
    {
        $collection = Recette::all();
        $budgets = Budget::where('type', 'Recette')->get();
        $contribuables = Contribuable::all();
        $bases = BaseTaxable::all();
        $sources = SourcePrelevement::all();

        return view('pages.recette.liste', compact('collection', 'budgets', 'contribuables', 'bases', 'sources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function entente_rectte()
    {
        $collection = Recette::where('statut', 'en attente')->get();

        $budgets = Budget::where('type', 'Recette')->get();
        $contribuables = Contribuable::all();
        $bases = BaseTaxable::all();
        $sources = SourcePrelevement::all();

        return view('pages.recette.liste', compact('collection', 'budgets', 'contribuables', 'bases', 'sources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function valide_rectte()
    {
        $collection = Recette::where('statut', 'valide')->get();

        $budgets = Budget::where('type', 'Recette')->get();
        $contribuables = Contribuable::all();
        $bases = BaseTaxable::all();
        $sources = SourcePrelevement::all();

        return view('pages.recette.liste', compact('collection', 'budgets', 'contribuables', 'bases', 'sources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reglement_rectte()
    {
        $collection = Recette::where('statut', 'en reglement')->get();

        $budgets = Budget::where('type', 'Recette')->get();
        $contribuables = Contribuable::all();
        $bases = BaseTaxable::all();
        $sources = SourcePrelevement::all();

        return view('pages.recette.liste', compact('collection', 'budgets', 'contribuables', 'bases', 'sources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function regle_recette()
    {
        $collection = Recette::where('statut', 'reglée')->get();

        $budgets = Budget::where('type', 'Recette')->get();
        $contribuables = Contribuable::all();
        $bases = BaseTaxable::all();
        $sources = SourcePrelevement::all();

        return view('pages.recette.liste', compact('collection', 'budgets', 'contribuables', 'bases', 'sources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recettes = Recette::create([
            'objet' => $request->objet,
            'date' => $request->date,
            'periode_debut' => $request->periode_debut,
            'periode_fin' => $request->periode_fin,
            'budgets_id' => $request->budgets_id,
            'contribuables_id' => $request->contribuables_id,
            'statut' => $request->statut,
            'echeance' => $request->echeance,
            'users_id' => $request->users_id,
            'signataires_id' => $request->signataires_id,
        ]);

        smilify('success', 'Ordre de recette ajouté avec succès !');
        return redirect("module_ordre_recette/" . $recettes->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_element(Request $request)
    {
        ElementRecette::create([
            'unite' => $request->unite,
            'quantite' => $request->quantite,
            'prix_unitaire' => $request->prix_unitaire,
            'base_taxables_id' => $request->base_taxables_id,
            'source_prelevements_id' => $request->source_prelevements_id,
            'recettes_id' => $request->recettes_id,
        ]);

        smilify('success', 'Element ajouté à l\'ordre de recette avec succès !');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $recette = Recette::find($id);
        $elements = ElementRecette::where('recettes_id', '=', $id)->get();

        $bases = BaseTaxable::all();
        $sources = SourcePrelevement::all();
        $budgets = Budget::where('type', 'recette')->get();
        $contribuables = Contribuable::all();

        $montant_total = $elements->sum('montant');

        return view('pages.recette.show', compact('recette', 'bases', 'sources', 'elements', 'budgets', 'contribuables', 'montant_total'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function valider()
    {
        $collection = Recette::where('statut', 'en attente')->get();

        return view('pages.recette.validation', compact('collection'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function en_reglement()
    {
        $collection = Recette::where('statut', 'valide')->get();

        return view('pages.recette.en_reglement', compact('collection'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function reglement_recette()
    {
        $collection = Recette::where('statut', 'en reglement')->get();

        return view('pages.recette.reglement', compact('collection'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function show_reglement(string $id)
    {
        $recette = Recette::find($id);
        $elements = ElementRecette::where('recettes_id', '=', $id)->get();
        $total = $elements->sum('montant');

        return view('pages.reglement.reglement', compact('recette', 'elements', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $recette = Recette::find($id);
        $elements = ElementRecette::where('recettes_id', '=', $id)->get();
        $budgets = Budget::where('type', 'recette')->get();

        $contribuables = Contribuable::all();

        return view('pages.recette.edit', compact('recette', 'elements', 'budgets', 'contribuables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $recette = Recette::find($id);
        $recette->update([
            'objet' => $request->objet,
            'date' => $request->date,
            'periode_debut' => $request->periode_debut,
            'periode_fin' => $request->periode_fin,
            'budgets_id' => $request->budgets_id,
            'contribuables_id' => $request->contribuables_id,
            'echeance' => $request->echeance,
        ]);

        smilify('success', 'Ordre de recette modifié avec succès !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function validation(string $id)
    {
        $recette = Recette::find($id);
        $recette->update([
            'statut' => 'valide',
        ]);

        smilify('success', 'Ordre de recette validé avec succès !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function reglement(string $id)
    {
        $recette = Recette::find($id);
        $recette->update([
            'statut' => 'en reglement',
        ]);

        smilify('success', 'Ordre de recette mis en reglement avec succès !');
        return redirect()->back();
    }

    public function print_recette(string $id)
    {
        $recette = Recette::find($id);
        $elements = ElementRecette::where('recettes_id', '=', $id)->get();

        $montant_total = $elements->sum('montant');

        $entetes = Entete::all();

        return view('pages.recette.print_recette', compact('recette', 'elements', 'montant_total', 'entetes',));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $recet = Recette::find($id);
        $recet->delete();

        smilify('error', 'L\'ordre de recette a été supprimer avec success !');
        return redirect()->route('all_recette');
    }

    public function destroy_element(string $id)
    {
        $elem = ElementRecette::find($id);
        $elem->delete();

        smilify('error', 'La ligne a été retirée de la facture !');
        return redirect()->back();
    }
}
