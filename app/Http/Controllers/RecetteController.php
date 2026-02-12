<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Entete;
use App\Models\Recette;
use App\Models\BaseTaxable;
use App\Models\Contribuable;
use App\Models\Marche;
use App\Models\Categorie;
use App\Models\Service;

use Illuminate\Http\Request;
use App\Models\ElementRecette;
use App\Models\SourcePrelevement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Recette::where('statut', 'en attente')->where('users_id', auth()->id())->paginate(10);
        $contribuables = Contribuable::all();
        $bases = BaseTaxable::all();
        $marches = Marche::all();
        $categories = Categorie::all();

        return view('pages.recette.index', compact('collection', 'contribuables', 'bases', 'marches', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_recette()
    {
        $collection = Recette::where('users_id', auth()->id())->get();
        $contribuables = Contribuable::all();
        $bases = BaseTaxable::all();
        $marches = Marche::all();
        $categories = Categorie::all();
        $services = Service::all();

        return view('pages.recette.liste', compact('collection', 'contribuables', 'bases', 'marches', 'categories', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function entente_rectte()
    {
        $collection = Recette::where('statut', 'en attente')->where('users_id', auth()->id())->get();

        $budgets = Budget::where('type', 'Recette')->get();
        $contribuables = Contribuable::all();
        $bases = BaseTaxable::all();
        $marches = Marche::all();
        $categories = Categorie::all();
        $services = Service::all();

        return view('pages.recette.liste', compact('collection', 'budgets', 'contribuables', 'bases', 'marches', 'categories', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function valide_rectte()
    {
        $collection = Recette::where('statut', 'valide')->where('users_id', auth()->id())->get();

        $budgets = Budget::where('type', 'Recette')->get();
        $contribuables = Contribuable::all();
        $bases = BaseTaxable::all();
        $marches = Marche::all();
        $categories = Categorie::all();
        $services = Service::all();

        return view('pages.recette.liste', compact('collection', 'budgets', 'contribuables', 'bases', 'marches', 'categories', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reglement_rectte()
    {
        $collection = Recette::where('statut', 'en reglement')->where('users_id', auth()->id())->get();

        $budgets = Budget::where('type', 'Recette')->get();
        $contribuables = Contribuable::all();
        $bases = BaseTaxable::all();
        $marches = Marche::all();
        $categories = Categorie::all();
        $services = Service::all();

        return view('pages.recette.liste', compact('collection', 'budgets', 'contribuables', 'bases', 'marches', 'categories', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function regle_recette()
    {
        $collection = Recette::where('statut', 'reglée')->where('users_id', auth()->id())->get();

        $budgets = Budget::where('type', 'Recette')->get();
        $contribuables = Contribuable::all();
        $bases = BaseTaxable::all();
        $marches = Marche::all();
        $categories = Categorie::all();
        $services = Service::all();

        return view('pages.recette.liste', compact('collection', 'budgets', 'contribuables', 'bases', 'marches', 'categories', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Créer la recette principale
            $recette = Recette::create([
                'reference' => $request->reference,
                'date' => $request->date,
                'code' => $request->code,
                'contribuables_id' => $request->contribuables_id,
                'statut' => $request->statut,
                'echeance' => $request->echeance,
                'users_id' => $request->users_id,
                'signataires_id' => $request->signataires_id,
                'marche_id' => $request->marche_id,
                'categorie_id' => $request->categorie_id,
                'service_id' => $request->service_id,
                'users_id' => $request->users_id,
            ]);

            // Ajouter tous les éléments de la recette
            if ($request->has('base_taxables_id') && is_array($request->base_taxables_id)) {
                foreach ($request->base_taxables_id as $index => $baseTaxableId) {
                    if (!empty($baseTaxableId)) {
                        ElementRecette::create([
                            'recettes_id' => $recette->id,
                            'base_taxables_id' => $baseTaxableId,
                            'quantite' => $request->quantite[$index] ?? 0,
                            'prix_unitaire' => $request->prix_unitaire[$index] ?? 0,
                            'designation' => $request->designation[$index] ?? 0,
                        ]);
                    }
                }
            }

            DB::commit();

            // Message de succès et redirection
            smilify('success', 'Ordre de recette ajouté avec succès avec ' . count($request->base_taxables_id) . ' élément(s) !');
            return redirect("module_ordre_recette/" . $recette->id);

        } catch (\Exception $e) {
            DB::rollBack();

            smilify('error', 'Erreur lors de la création de l\'ordre de recette : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
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
        $budgets = Budget::where('type', 'recette')->get();
        $contribuables = Contribuable::all();
        $services = Service::all();

        $marches = Marche::all();
        $categories = Categorie::all();


        $montant_total = $elements->sum('montant') - $recette->total_retenu;

        return view('pages.recette.show', compact('recette', 'bases', 'elements', 'budgets', 'contribuables', 'services', 'marches', 'categories', 'montant_total'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function valider()
    {
        $collection = Recette::where('statut', 'en attente')->where('users_id', auth()->id())->get();

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
        $collection = Recette::where('statut', 'valide')->where('users_id', auth()->id())->get();

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
        $collection = Recette::where('statut', 'en reglement')->where('users_id', auth()->id())->get();

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
        $services = Service::all();
        $marches = Marche::all();
        $categories = Categorie::all();

        return view('pages.recette.edit', compact('recette', 'elements', 'budgets', 'contribuables', 'services', 'marches', 'categories'));
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
            'reference' => $request->reference,
            'date' => $request->date,
            'code' => $request->code,
            'contribuables_id' => $request->contribuables_id,
            'echeance' => $request->echeance,
            'service_id' => $request->service_id,
            'categorie_id' => $request->categorie_id,
            'marche_id' => $request->marche_id,
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
    public function reglement(Request $request, string $id)
    {
        // Mettre à jour le statut de la recette
        $recette = Recette::find($id);
        $recette->update([
            'statut' => 'en reglement',
        ]);

        // Récupérer tous les éléments de cette recette
        $elements = ElementRecette::where('recettes_id', '=', $id)->get();

        // Traiter chaque élément
        foreach ($elements as $element) {
            // Récupérer le montant initial de l'élément
            $montant_initial = $element->montant;

            // Calculer retenu_bic (pourcentage du montant)
            $retenu_bic = ($montant_initial * ($request->retenu_bic ?? 0)) / 100;

            // Récupérer autres_retenu depuis la requête
            $autres_retenu = $request->autres_retenu ?? 0;

            // Calculer total_retenu
            $total_retenu = $retenu_bic + $autres_retenu;

            // Calculer le nouveau montant
            $nouveau_montant = $montant_initial - $total_retenu;

            // Mettre à jour l'élément
            $element->update([
                'retenu_bic' => $retenu_bic,
                'autres_retenu' => $autres_retenu,
                'total_retenu' => $total_retenu,
                'montant' => $nouveau_montant,
            ]);
        }

        smilify('success', 'Ordre de recette mis en reglement avec succès !');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function print_recette(string $id)
    {
        $recette = Recette::find($id);
        $elements = ElementRecette::where('recettes_id', '=', $id)->get();

        $montant_total = $elements->sum('montant');
        $tva = $montant_total * 0.18;
        $montant_total_ttc = $montant_total + $tva;

        $entetes = Entete::all();

        return view('pages.recette.print_recette', compact('recette', 'elements', 'montant_total', 'tva', 'montant_total_ttc', 'entetes',));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function printBonExecution(string $id)
    {
        $recette = Recette::find($id);
        $elements = ElementRecette::where('recettes_id', '=', $id)->get();

        $entetes = Entete::all();

        return view('pages.recette.print_bon_execution', compact('recette', 'elements', 'entetes',));
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
        return redirect()->back();
    }

    public function destroy_element(string $id)
    {
        $elem = ElementRecette::find($id);
        $elem->delete();

        smilify('error', 'La ligne a été retirée de la facture !');
        return redirect()->back();
    }
}
