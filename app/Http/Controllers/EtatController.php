<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contribuable;
use App\Models\Recette;
use App\Models\ReglementFacture;
use App\Models\Fournisseur;
use App\Models\FactureFournisseur;
use App\Models\ReglementFournisseur;
use App\Models\ElementFacture;
use App\Models\Marche;
use App\Models\MarcheDetail;
use App\Models\Diligence;
use App\Models\Categorie;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class EtatController extends Controller
{
    // etat solde clients
    public function solde_client(Request $request)
    {
        $contribuables = Contribuable::orderBy('id', 'asc')->get();

        // Initialiser la collection de soldes
        $soldes = collect([]);

        // Si des critères de recherche sont présents
        if ($request->has('contribuable_id') || $request->has('date_debut') || $request->has('date_fin')) {
            // Query de base pour les recettes avec jointure sur element_recettes
            $query = Recette::with('contribuable')
                ->join('element_recettes', 'recettes.id', '=', 'element_recettes.recettes_id')
                ->select('recettes.contribuables_id')
                ->selectRaw('SUM(element_recettes.montant) as total_facture');

            // Filtrer par client si spécifié
            if ($request->filled('contribuable_id')) {
                $query->where('recettes.contribuables_id', $request->contribuable_id);
            }

            // Filtrer par date de début (période_debut ou created_at)
            if ($request->filled('date_debut')) {
                $query->where(function($q) use ($request) {
                    $q->where('recettes.periode_debut', '>=', $request->date_debut)
                      ->orWhere('recettes.created_at', '>=', $request->date_debut);
                });
            }

            // Filtrer par date de fin (période_fin ou created_at)
            if ($request->filled('date_fin')) {
                $query->where(function($q) use ($request) {
                    $q->where('recettes.periode_fin', '<=', $request->date_fin)
                      ->orWhere('recettes.created_at', '<=', $request->date_fin);
                });
            }

            $query->groupBy('recettes.contribuables_id');

            $recettes = $query->get();

            // Récupérer les règlements correspondants
            foreach ($recettes as $recette) {
                // Charger le contribuable
                $contribuable = Contribuable::find($recette->contribuables_id);

                $reglementQuery = ReglementFacture::whereHas('recette', function($q) use ($recette, $request) {
                    $q->where('contribuables_id', $recette->contribuables_id);

                    if ($request->filled('date_debut')) {
                        $q->where(function($query) use ($request) {
                            $query->where('periode_debut', '>=', $request->date_debut)
                                  ->orWhere('created_at', '>=', $request->date_debut);
                        });
                    }

                    if ($request->filled('date_fin')) {
                        $q->where(function($query) use ($request) {
                            $query->where('periode_fin', '<=', $request->date_fin)
                                  ->orWhere('created_at', '<=', $request->date_fin);
                        });
                    }
                });

                $totalRegle = $reglementQuery->sum('versement');

                $soldes->push((object)[
                    'contribuable' => $contribuable,
                    'total_facture' => $recette->total_facture ?? 0,
                    'total_regle' => $totalRegle ?? 0,
                    'solde' => ($recette->total_facture ?? 0) - ($totalRegle ?? 0)
                ]);
            }
        }

        return view('pages.etats.solde_client', compact('contribuables', 'soldes'));
    }

    // etat solde fournisseurs
    public function solde_fournisseur(Request $request)
    {
        $fournisseurs = Fournisseur::orderBy('libelle', 'asc')->get();

        // Initialiser la collection de soldes
        $soldes = collect([]);

        // Si des critères de recherche sont présents
        if ($request->has('fournisseur_id') || $request->has('date_debut') || $request->has('date_fin')) {
            // Query de base pour les factures fournisseurs
            $query = FactureFournisseur::with(['Fournisseur', 'ElementFacture'])
                ->select('fournisseur_id')
                ->selectRaw('SUM((SELECT SUM(montant_total) FROM element_factures WHERE element_factures.facture_fournisseurs_id = facture_fournisseurs.id)) as total_facture');

            // Filtrer par fournisseur si spécifié
            if ($request->filled('fournisseur_id')) {
                $query->where('facture_fournisseurs.fournisseur_id', $request->fournisseur_id);
            }

            // Filtrer par date de début
            if ($request->filled('date_debut')) {
                $query->where('facture_fournisseurs.date', '>=', $request->date_debut);
            }

            // Filtrer par date de fin
            if ($request->filled('date_fin')) {
                $query->where('facture_fournisseurs.date', '<=', $request->date_fin);
            }

            $query->groupBy('facture_fournisseurs.fournisseur_id');

            $factures = $query->get();

            // Récupérer les règlements correspondants
            foreach ($factures as $facture) {
                // Charger le fournisseur
                $fournisseur = Fournisseur::find($facture->fournisseur_id);

                // Query pour les règlements
                $reglementQuery = ReglementFournisseur::whereHas('FactureFournisseur', function($q) use ($facture, $request) {
                    $q->where('fournisseur_id', $facture->fournisseur_id);

                    if ($request->filled('date_debut')) {
                        $q->where('date', '>=', $request->date_debut);
                    }

                    if ($request->filled('date_fin')) {
                        $q->where('date', '<=', $request->date_fin);
                    }
                });

                $totalRegle = $reglementQuery->sum('versement');

                $soldes->push((object)[
                    'fournisseur' => $fournisseur,
                    'total_facture' => $facture->total_facture ?? 0,
                    'total_regle' => $totalRegle ?? 0,
                    'solde' => ($facture->total_facture ?? 0) - ($totalRegle ?? 0)
                ]);
            }
        }

        return view('pages.etats.solde_fournisseur', compact('fournisseurs', 'soldes'));
    }

    // etat des marches global
    public function marche_global(Request $request)
    {
        $marches = Marche::orderBy('code', 'asc')->get();

        // Initialiser la collection de résultats
        $resultats = collect([]);

        // Si des critères de recherche sont présents
        if ($request->has('marche_id') || $request->has('date_debut') || $request->has('date_fin')) {
            // Query de base pour les marchés
            $query = Marche::with(['contribuable', 'baseTaxable', 'details', 'diligences']);

            // Filtrer par marché si spécifié
            if ($request->filled('marche_id')) {
                $query->where('marches.id', $request->marche_id);
            }

            // Filtrer par date de début
            if ($request->filled('date_debut')) {
                $query->where('marches.date_debut', '>=', $request->date_debut);
            }

            // Filtrer par date de fin
            if ($request->filled('date_fin')) {
                $query->where('marches.date_cloture', '<=', $request->date_fin);
            }

            $marchesData = $query->get();

            // Calculer les montants exécutés pour chaque marché
            foreach ($marchesData as $marche) {
                // Calculer le montant exécuté à partir des diligences (basé sur le taux)
                $tauxTotal = 0;
                foreach ($marche->diligences as $diligence) {
                    $tauxTotal += floatval($diligence->taux ?? 0);
                }

                // Montant exécuté = (montant du marché * taux total) / 100
                $montantExecute = ($marche->montant * $tauxTotal) / 100;

                // Calculer le reste à exécuter
                $reste = $marche->montant - $montantExecute;

                $resultats->push((object)[
                    'id' => $marche->id,
                    'code' => $marche->code,
                    'designation' => $marche->designation,
                    'montant' => $marche->montant,
                    'montant_execute' => $montantExecute,
                    'reste' => $reste,
                    'date_debut' => $marche->date_debut,
                    'date_cloture' => $marche->date_cloture,
                    'contribuable' => $marche->contribuable,
                    'baseTaxable' => $marche->baseTaxable,
                    'details' => $marche->details,
                    'diligences' => $marche->diligences,
                ]);
            }
        }

        return view('pages.etats.etat_marche', compact('marches', 'resultats'));
    }

    // etat des marches detaille
    public function marche_detaille(Request $request)
    {
        // Récupérer tous les marchés pour le formulaire
        $marches = Marche::with('contribuable')->orderBy('code', 'asc')->get();

        // Initialiser la collection de résultats
        $resultats = collect([]);

        // Si des critères de recherche sont présents
        if ($request->has('marche_id') || $request->has('date_debut') || $request->has('date_fin')) {
            // Query de base pour les marchés
            $query = Marche::with(['contribuable', 'baseTaxable']);

            // Filtrer par marché si spécifié
            if ($request->filled('marche_id')) {
                $query->where('marches.id', $request->marche_id);
            }

            // Filtrer par date de début
            if ($request->filled('date_debut')) {
                $query->where('marches.date_debut', '>=', $request->date_debut);
            }

            // Filtrer par date de fin
            if ($request->filled('date_fin')) {
                $query->where('marches.date_cloture', '<=', $request->date_fin);
            }

            $marchesData = $query->get();

            // Pour chaque marché, récupérer les factures fournisseurs associées
            foreach ($marchesData as $marche) {
                // Récupérer les recettes liées au marché
                $recettesQuery = Recette::where('marche_id', $marche->id);

                // Appliquer les filtres de date sur les recettes si nécessaire
                if ($request->filled('date_debut')) {
                    $recettesQuery->where(function($q) use ($request) {
                        $q->where('periode_debut', '>=', $request->date_debut)
                          ->orWhere('created_at', '>=', $request->date_debut);
                    });
                }

                if ($request->filled('date_fin')) {
                    $recettesQuery->where(function($q) use ($request) {
                        $q->where('periode_fin', '<=', $request->date_fin)
                          ->orWhere('created_at', '<=', $request->date_fin);
                    });
                }

                $recettes = $recettesQuery->get();

                // Récupérer toutes les factures fournisseurs liées au contribuable du marché
                // (logique métier: les factures du même client que le marché)
                $facturesQuery = FactureFournisseur::with(['Fournisseur', 'ElementFacture', 'ReglementFournisseur']);

                // Filtrer les factures par dates si spécifiées
                if ($request->filled('date_debut')) {
                    $facturesQuery->where('date', '>=', $request->date_debut);
                }

                if ($request->filled('date_fin')) {
                    $facturesQuery->where('date', '<=', $request->date_fin);
                }

                // Récupérer toutes les factures pour ce marché (basées sur les dates du marché)
                if (!$request->filled('date_debut') && !$request->filled('date_fin')) {
                    $facturesQuery->whereBetween('date', [
                        $marche->date_debut ?? now()->subYear(),
                        $marche->date_cloture ?? now()
                    ]);
                }

                $factures = $facturesQuery->orderBy('date', 'asc')->get();

                // Calculer les totaux
                $totalFacture = 0;
                $totalRegle = 0;

                foreach ($factures as $facture) {
                    $montantHT = $facture->ElementFacture->sum('montant_total');
                    $montantTVA = ($montantHT * ($facture->tva ?? 0)) / 100;
                    $montantTTC = $montantHT + $montantTVA;
                    $totalFacture += $montantTTC;

                    // Calculer le total réglé
                    $totalRegle += $facture->ReglementFournisseur->sum('versement');
                }

                $reste = $totalFacture - $totalRegle;

                // Toujours ajouter le marché aux résultats (même sans factures)
                $resultats->push((object)[
                    'marche' => $marche,
                    'factures' => $factures,
                    'recettes' => $recettes,
                    'total_facture' => $totalFacture,
                    'total_regle' => $totalRegle,
                    'reste' => $reste,
                ]);
            }
        }

        return view('pages.etats.detail_marche', compact('marches', 'resultats'));
    }

    // etat facture par categorie
    public function facture_categorie(Request $request)
    {
        // Récupérer toutes les catégories pour le formulaire
        $categories = Categorie::orderBy('libelle', 'asc')->get();

        // Initialiser la collection de résultats
        $resultats = collect([]);

        // Si des critères de recherche sont présents
        if ($request->has('categorie_id') || $request->has('date_debut') || $request->has('date_fin')) {
            // Query de base pour les catégories
            $query = Categorie::query();

            // Filtrer par catégorie si spécifié
            if ($request->filled('categorie_id')) {
                $query->where('categories.id', $request->categorie_id);
            }

            $categoriesData = $query->get();

            // Pour chaque catégorie, récupérer les recettes associées
            foreach ($categoriesData as $categorie) {
                // Récupérer les recettes liées à la catégorie
                $recettesQuery = Recette::with(['Contribuable', 'ElementRecette', 'Reglement'])
                    ->where('categorie_id', $categorie->id);

                // Appliquer les filtres de date sur les recettes
                if ($request->filled('date_debut')) {
                    $recettesQuery->where(function($q) use ($request) {
                        $q->where('periode_debut', '>=', $request->date_debut)
                          ->orWhere('created_at', '>=', $request->date_debut);
                    });
                }

                if ($request->filled('date_fin')) {
                    $recettesQuery->where(function($q) use ($request) {
                        $q->where('periode_fin', '<=', $request->date_fin)
                          ->orWhere('created_at', '<=', $request->date_fin);
                    });
                }

                $recettes = $recettesQuery->orderBy('created_at', 'desc')->get();

                // Calculer les totaux
                $totalMontant = 0;
                $totalRegle = 0;

                foreach ($recettes as $recette) {
                    // Calculer le montant total de la recette
                    $montantRecette = $recette->ElementRecette->sum('montant');
                    $totalMontant += $montantRecette;

                    // Calculer le total réglé
                    $totalRegle += $recette->Reglement->sum('versement');
                }

                $reste = $totalMontant - $totalRegle;

                // Ajouter la catégorie aux résultats si elle a des recettes
                if ($recettes->count() > 0) {
                    $resultats->push((object)[
                        'categorie' => $categorie,
                        'recettes' => $recettes,
                        'total_montant' => $totalMontant,
                        'total_regle' => $totalRegle,
                        'reste' => $reste,
                    ]);
                }
            }
        }

        return view('pages.etats.etat_categorie', compact('categories', 'resultats'));
    }

    // etat facture par departement
    public function facture_departement(Request $request)
    {
        // Récupérer tous les services pour le formulaire
        $services = Service::orderBy('libelle', 'asc')->get();

        // Initialiser la collection de résultats
        $resultats = collect([]);

        // Si des critères de recherche sont présents
        if ($request->has('service_id') || $request->has('date_debut') || $request->has('date_fin')) {
            // Query de base pour les services
            $query = Service::query();

            // Filtrer par service si spécifié
            if ($request->filled('service_id')) {
                $query->where('services.id', $request->service_id);
            }

            $servicesData = $query->get();

            // Pour chaque service, récupérer les recettes associées
            foreach ($servicesData as $service) {
                // Récupérer les recettes liées au service
                $recettesQuery = Recette::with(['Contribuable', 'Categorie', 'ElementRecette', 'Reglement'])
                    ->where('service_id', $service->id);

                // Appliquer les filtres de date sur les recettes
                if ($request->filled('date_debut')) {
                    $recettesQuery->where(function($q) use ($request) {
                        $q->where('periode_debut', '>=', $request->date_debut)
                          ->orWhere('created_at', '>=', $request->date_debut);
                    });
                }

                if ($request->filled('date_fin')) {
                    $recettesQuery->where(function($q) use ($request) {
                        $q->where('periode_fin', '<=', $request->date_fin)
                          ->orWhere('created_at', '<=', $request->date_fin);
                    });
                }

                $recettes = $recettesQuery->orderBy('created_at', 'desc')->get();

                // Calculer les totaux
                $totalMontant = 0;
                $totalRegle = 0;

                foreach ($recettes as $recette) {
                    // Calculer le montant total de la recette
                    $montantRecette = $recette->ElementRecette->sum('montant');
                    $totalMontant += $montantRecette;

                    // Calculer le total réglé
                    $totalRegle += $recette->Reglement->sum('versement');
                }

                $reste = $totalMontant - $totalRegle;

                // Ajouter le service aux résultats si il a des recettes
                if ($recettes->count() > 0) {
                    $resultats->push((object)[
                        'service' => $service,
                        'recettes' => $recettes,
                        'total_montant' => $totalMontant,
                        'total_regle' => $totalRegle,
                        'reste' => $reste,
                    ]);
                }
            }
        }

        return view('pages.etats.etat_departement', compact('services', 'resultats'));
    }
}
