<?php

namespace App\Http\Controllers;

use App\Models\Entete;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\ElementFacture;
use App\Models\FactureFournisseur;
use App\Models\BaseTaxable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FactureFournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = FactureFournisseur::where('statut', 'en attente')->where('users_id', auth()->id())->paginate(10);
        $prestations = BaseTaxable::all();
        $fournisseurs = Fournisseur::all();

        return view('pages.facure_fournisseur.index',compact('collection', 'prestations', 'fournisseurs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'statut' => 'required|string',
            'tva' => 'nullable|numeric|min:0|max:100',
            'objet' => 'nullable|string|max:255',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'base_taxable_id' => 'required|exists:base_taxables,id',
            'users_id' => 'required|exists:users,id',
            'signataires_id' => 'required|exists:signataires,id',

            // Validation des éléments de facture
            'designation' => 'required|array|min:1',
            'designation.*' => 'required|string|max:255',
            'quantite' => 'required|array|min:1',
            'quantite.*' => 'required|numeric|min:1',
            'prix_unitaire' => 'required|array|min:1',
            'prix_unitaire.*' => 'required|numeric|min:0',
        ], [
            'date.required' => 'La date est obligatoire.',
            'fournisseur_id.required' => 'Le fournisseur est obligatoire.',
            'fournisseur_id.exists' => 'Le fournisseur sélectionné n\'existe pas.',
            'base_taxable_id.required' => 'La prestation est obligatoire.',
            'base_taxable_id.exists' => 'La prestation sélectionnée n\'existe pas.',
            'signataires_id.required' => 'Le signataire est obligatoire.',
            'signataires_id.exists' => 'Le signataire sélectionné n\'existe pas.',
            'tva.numeric' => 'La TVA doit être un nombre.',
            'tva.min' => 'La TVA ne peut pas être négative.',
            'tva.max' => 'La TVA ne peut pas dépasser 100%.',

            'designation.required' => 'Au moins un élément de facture est requis.',
            'designation.min' => 'Au moins un élément de facture est requis.',
            'designation.*.required' => 'La désignation est obligatoire pour chaque élément.',
            'quantite.*.required' => 'La quantité est obligatoire pour chaque élément.',
            'quantite.*.numeric' => 'La quantité doit être un nombre.',
            'quantite.*.min' => 'La quantité doit être au moins 1.',
            'prix_unitaire.*.required' => 'Le prix unitaire est obligatoire pour chaque élément.',
            'prix_unitaire.*.numeric' => 'Le prix unitaire doit être un nombre.',
            'prix_unitaire.*.min' => 'Le prix unitaire ne peut pas être négatif.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)->withInput();
        }

        // Vérifier que les tableaux ont la même taille
        $designations = $request->designation;
        $quantites = $request->quantite;
        $prix_unitaires = $request->prix_unitaire;

        if (count($designations) !== count($quantites) || count($designations) !== count($prix_unitaires)) {
            smilify('error', 'Erreur : Les données des éléments de facture sont incohérentes.');
            return redirect()->back()->withInput();
        }

        // Utiliser une transaction pour garantir l'intégrité des données
        DB::beginTransaction();

        try {
            // Créer la facture fournisseur
            $fact = FactureFournisseur::create([
                'date' => $request->date,
                'statut' => $request->statut,
                'tva' => $request->tva ?? 0,
                'objet' => $request->objet,
                'fournisseur_id' => $request->fournisseur_id,
                'base_taxable_id' => $request->base_taxable_id,
                'users_id' => $request->users_id,
                'signataires_id' => $request->signataires_id,
                'retenu_bic' => 0,
                'retenu_arcop' => 0,
                'penalite' => 0,
                'total_retenu' => 0,
            ]);

            // Compteur d'éléments créés
            $elementsCount = 0;

            // Créer les éléments de la facture
            foreach ($designations as $index => $designation) {
                // Vérifier que la désignation n'est pas vide
                if (!empty(trim($designation))) {
                    $quantite = $quantites[$index] ?? 0;
                    $prix_unitaire = $prix_unitaires[$index] ?? 0;

                    // Calculer le montant total
                    $montant_total = $quantite * $prix_unitaire;

                    // Créer l'élément
                    ElementFacture::create([
                        'designation' => trim($designation),
                        'quantite' => $quantite,
                        'prix_unitaire' => $prix_unitaire,
                        'montant_total' => $montant_total,
                        'facture_fournisseurs_id' => $fact->id,
                    ]);

                    $elementsCount++;
                }
            }

            // Vérifier qu'au moins un élément a été créé
            if ($elementsCount === 0) {
                throw new \Exception('Aucun élément de facture valide n\'a été fourni.');
            }

            // Valider la transaction
            DB::commit();

            smilify('success', 'Facture fournisseur créée avec succès ! (' . $elementsCount . ' élément(s) ajouté(s))');
            return redirect("module_facture_fournisseur/" . $fact->id);

        } catch (\Exception $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollBack();

            smilify('error', 'Erreur lors de la création de la facture : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
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

        $prestations = BaseTaxable::all();
        $fournisseurs = Fournisseur::all();

        $tota_ret = $factures->total_retenu;

        $total_ht = $elements->sum('montant_total') - $factures->total_retenu;

        $total_ttc = $elements->sum('montant_total') + ($elements->sum('montant_total') * $factures->tva / 100) - $factures->total_retenu;

        return view('pages.facure_fournisseur.show',compact('factures', 'elements', 'prestations', 'fournisseurs', 'total_ht', 'total_ttc', 'tota_ret'));
    }

    /**
     * Update an element of the facture.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function update_facture_element(Request $request, String $id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'designation' => 'required|string|max:255',
            'quantite' => 'required|numeric|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
        ], [
            'designation.required' => 'La désignation est obligatoire.',
            'quantite.required' => 'La quantité est obligatoire.',
            'quantite.numeric' => 'La quantité doit être un nombre.',
            'quantite.min' => 'La quantité doit être au moins 1.',
            'prix_unitaire.required' => 'Le prix unitaire est obligatoire.',
            'prix_unitaire.numeric' => 'Le prix unitaire doit être un nombre.',
            'prix_unitaire.min' => 'Le prix unitaire ne peut pas être négatif.',
        ]);

        if ($validator->fails()) {
            smilify('error', 'Erreur de validation : ' . $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $element = ElementFacture::findOrFail($id);

            // Calculer le nouveau montant total
            $montant_total = $request->quantite * $request->prix_unitaire;

            // Mettre à jour l'élément
            $element->update([
                'designation' => trim($request->designation),
                'quantite' => $request->quantite,
                'prix_unitaire' => $request->prix_unitaire,
                'montant_total' => $montant_total,
            ]);

            smilify('success', 'Élément modifié avec succès !');
            return redirect()->back();

        } catch (\Exception $e) {
            smilify('error', 'Erreur lors de la modification de l\'élément : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\facure_fournisseur  $facure_fournisseur
     * @return \Illuminate\Http\Response
     */
    public function valider()
    {
        $collection = FactureFournisseur::where('statut', 'en attente')->where('users_id', auth()->id())->paginate(10);

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
        $collection = FactureFournisseur::where('statut', 'valide')->where('users_id', auth()->id())->paginate(10);

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
        $collection = FactureFournisseur::where('statut', 'en reglement')->where('users_id', auth()->id())->paginate(10);

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
        $factures = FactureFournisseur::where('id', $id)->where('users_id', auth()->id())->firstOrFail();
        $elements = ElementFacture::where('facture_fournisseurs_id', '=', $id)->get();
        $total = $elements->sum('montant_total');

        $total_ret = $factures->total_retenu;

        $total_ht = $elements->sum('montant_total') - $factures->total_retenu;

        $total_ttc = $elements->sum('montant_total') + ($elements->sum('montant_total') * $factures->tva / 100) - $factures->total_retenu;

        return view('pages.reglement_facture.reglement',compact('factures', 'elements', 'total', 'total_ttc', 'total_ht'));
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
        // Validation des données
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'tva' => 'nullable|numeric|min:0|max:100',
            'objet' => 'nullable|string|max:255',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'base_taxable_id' => 'required|exists:base_taxables,id',
            'signataires_id' => 'required|exists:signataires,id',
            'retenu_bic' => 'nullable|numeric|min:0',
            'retenu_arcop' => 'nullable|numeric|min:0',
            'penalite' => 'nullable|numeric|min:0',
        ], [
            'date.required' => 'La date est obligatoire.',
            'fournisseur_id.required' => 'Le fournisseur est obligatoire.',
            'fournisseur_id.exists' => 'Le fournisseur sélectionné n\'existe pas.',
            'base_taxable_id.required' => 'La prestation est obligatoire.',
            'base_taxable_id.exists' => 'La prestation sélectionnée n\'existe pas.',
            'signataires_id.required' => 'Le signataire est obligatoire.',
            'signataires_id.exists' => 'Le signataire sélectionné n\'existe pas.',
            'tva.numeric' => 'La TVA doit être un nombre.',
            'tva.min' => 'La TVA ne peut pas être négative.',
            'tva.max' => 'La TVA ne peut pas dépasser 100%.',
        ]);

        if ($validator->fails()) {
            smilify('error', 'Erreur de validation : ' . $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $facture = FactureFournisseur::findOrFail($id);

            // Calculer le total retenu si les champs sont présents
            $total_retenu = ($request->retenu_bic ?? $facture->retenu_bic ?? 0)
                          + ($request->retenu_arcop ?? $facture->retenu_arcop ?? 0)
                          + ($request->penalite ?? $facture->penalite ?? 0);

            // Mettre à jour la facture
            $facture->update([
                'date' => $request->date,
                'tva' => $request->tva ?? 0,
                'objet' => $request->objet,
                'fournisseur_id' => $request->fournisseur_id,
                'base_taxable_id' => $request->base_taxable_id,
                'signataires_id' => $request->signataires_id,
                'retenu_bic' => $request->retenu_bic ?? $facture->retenu_bic,
                'retenu_arcop' => $request->retenu_arcop ?? $facture->retenu_arcop,
                'penalite' => $request->penalite ?? $facture->penalite,
                'total_retenu' => $total_retenu,
            ]);

            smilify('success', 'Facture fournisseur modifiée avec succès !');
            return redirect()->back();

        } catch (\Exception $e) {
            smilify('error', 'Erreur lors de la modification : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
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
        $collection = FactureFournisseur::where('users_id', auth()->id())->paginate(10);
        $budgets = BaseTaxable::all();
        $fournisseurs = Fournisseur::all();

        return view('pages.facure_fournisseur.liste',compact('collection', 'budgets', 'fournisseurs'));
    }

    public function entente_facture()
    {
        $collection = FactureFournisseur::where('statut', 'en attente')->where('users_id', auth()->id())->paginate(10);
        $budgets = BaseTaxable::all();
        $fournisseurs = Fournisseur::all();

        return view('pages.facure_fournisseur.liste',compact('collection', 'budgets', 'fournisseurs'));
    }

    public function valide_facture()
    {
        $collection = FactureFournisseur::where('statut', 'valide')->where('users_id', auth()->id())->paginate(10);
        $budgets = BaseTaxable::all();
        $fournisseurs = Fournisseur::all();

        return view('pages.facure_fournisseur.liste',compact('collection', 'budgets', 'fournisseurs'));
    }

    public function reglem_fact()
    {
        $collection = FactureFournisseur::where('statut', 'en reglement')->where('users_id', auth()->id())->paginate(10);
        $budgets = BaseTaxable::all();
        $fournisseurs = Fournisseur::all();

        return view('pages.facure_fournisseur.liste',compact('collection', 'budgets', 'fournisseurs'));
    }

    public function regle_fact()
    {
        $collection = FactureFournisseur::where('statut', 'reglée')->where('users_id', auth()->id())->paginate(10);
        $budgets = BaseTaxable::all();
        $fournisseurs = Fournisseur::all();

        return view('pages.facure_fournisseur.liste',compact('collection', 'budgets', 'fournisseurs'));
    }

    public function print_facture(string $id)
    {
        $factures = FactureFournisseur::where('id', $id)->where('users_id', auth()->id())->firstOrFail();
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
        $fact = FactureFournisseur::where('id', $id)->where('users_id', auth()->id())->firstOrFail();
        $fact->delete();

        smilify('error', 'La facture a été supprimer avec success !');
        return redirect()->back();
    }

    public function destroy_element(string $id)
    {
        $elem = ElementFacture::where('id', $id)->where('users_id', auth()->id())->firstOrFail();
        $elem->delete();

        smilify('error', 'La ligne a été retirée de la facture !');
        return redirect()->back();
    }
}
