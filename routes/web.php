<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\EnteteController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\BaseTaxableController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ContribuableController;
use App\Http\Controllers\EtatController;
use App\Http\Controllers\ReglementFactureController;
use App\Http\Controllers\SourcePrelevementController;

use App\Http\Controllers\FactureFournisseurController;
use App\Http\Controllers\ReglementFournisseurController;
use App\Http\Controllers\SignataireController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DiligenceController;
use App\Http\Controllers\CritereController;
use App\Http\Controllers\TraitementController;
use App\Http\Controllers\MarcheController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'auth'])->name('login');
Route::post('authentification', [AuthController::class, 'login'])->name('auth');
Route::post('deconnexion', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    Route::resource('module_categorie', CategorieController::class);

    Route::resource('module_entete', EnteteController::class);

    Route::resource('module_famille', FamilleController::class);

    Route::resource('module_base_taxable', BaseTaxableController::class);

    Route::resource('module_contribuable', ContribuableController::class);

    Route::resource('module_fornisseur', FournisseurController::class);

    Route::resource('module_signataire', SignataireController::class);

    Route::resource('module_source_prelevement', SourcePrelevementController::class);

    Route::resource('module_budget', BudgetController::class);

    Route::resource('module_ordre_recette', RecetteController::class);
    Route::post('add_element_row_recette', [RecetteController::class, 'add_element'])->name('add_element_recette');
    Route::get('recette_validation', [RecetteController::class, 'valider'])->name('valider');
    Route::post('validation_facture/{id}', [RecetteController::class, 'validation']);
    Route::get('recette_en_reglement', [RecetteController::class, 'en_reglement'])->name('mise_reglement');
    Route::post('recette_en_reglement/{id}', [RecetteController::class, 'reglement']);
    Route::get('reglement_odre_recette', [RecetteController::class, 'reglement_recette'])->name('reglement_recette');
    Route::get('view_reglement/{id}', [RecetteController::class, 'show_reglement']);
    Route::get('tous_odre_recette', [RecetteController::class, 'all_recette'])->name('all_recette');
    Route::get('odre_recette_encours', [RecetteController::class, 'entente_rectte'])->name('entente_recette');
    Route::get('odre_recette_valide', [RecetteController::class, 'valide_rectte'])->name('valide_rectte');
    Route::get('odre_recette_en_reglement', [RecetteController::class, 'reglement_rectte'])->name('reglement_rectte');
    Route::get('odre_recette_reglee', [RecetteController::class, 'regle_recette'])->name('regle_recette');
    Route::get('print_ordre_recette/{id}', [RecetteController::class, 'print_recette']);
    Route::get('print_bon_execution/{id}', [RecetteController::class, 'printBonExecution'])->name('print_bon_execution');
    Route::get('supp_ordre_recette/{id}', [RecetteController::class, 'destroy']);
    Route::get('supp_element_recette/{id}', [RecetteController::class, 'destroy_element']);

    Route::resource('module_reglement', ReglementFactureController::class);
    Route::get('print_reglement_recette/{id}', [ReglementFactureController::class, 'print_regle_recette']);

    Route::resource('module_reglement_fournisseur', ReglementFournisseurController::class);
    Route::get('print_reglement_facture/{id}', [ReglementFournisseurController::class, 'print_regle_facture']);

    Route::resource('module_facture_fournisseur', FactureFournisseurController::class);
    Route::post('add_element_row', [FactureFournisseurController::class, 'add_facture_element'])->name('add_facture_element');
    Route::patch('update_element_row/{id}', [FactureFournisseurController::class, 'update_facture_element'])->name('update_facture_element');
    Route::get('facture_validation', [FactureFournisseurController::class, 'valider'])->name('valider_facture');
    Route::post('validation/{id}', [FactureFournisseurController::class, 'validation']);
    Route::get('facture_en_reglement', [FactureFournisseurController::class, 'en_reglement'])->name('mise_reglement_facture');
    Route::post('reglement_facture/{id}', [FactureFournisseurController::class, 'reglement']);
    Route::get('reglement_facture_fournisseur', [FactureFournisseurController::class, 'reglement_facture'])->name('reglement_facture');
    Route::get('view_reglement_fact/{id}', [FactureFournisseurController::class, 'show_reglement_fact']);
    Route::get('print_facture_fourn/{id}', [FactureFournisseurController::class, 'print_facture']);

    Route::get('tous_factures_fournisseurs', [FactureFournisseurController::class, 'all_facture'])->name('all_facture');
    Route::get('factures_fournisseurs_encours', [FactureFournisseurController::class, 'entente_facture'])->name('entente_facture');
    Route::get('factures_fournisseurs_valide', [FactureFournisseurController::class, 'valide_facture'])->name('valide_facture');
    Route::get('factures_fournisseurs_en_reglement', [FactureFournisseurController::class, 'reglem_fact'])->name('reglem_fact');
    Route::get('factures_fournisseurs_reglee', [FactureFournisseurController::class, 'regle_fact'])->name('regle_fact');
    Route::get('supp_facture_fournisseur/{id}', [FactureFournisseurController::class, 'destroy']);
    Route::get('supp_element_facture_fournisseur/{id}', [FactureFournisseurController::class, 'destroy_element']);

    Route::get('etat/budget_depense', [EtatController::class, 'etat_budget_depense'])->name('etat_budget_depense');
    Route::get('etat/tous_budget_depense', [EtatController::class, 'etat_tous_budget'])->name('etat_tous_budget');
    Route::get('etat/budget_rectte', [EtatController::class, 'etat_budget_recette'])->name('etat_budget_recette');
    Route::get('etat/tous_budget_rectte', [EtatController::class, 'tous_budget_recette'])->name('etat_tous_budget_recette');
    Route::get('etat/depense_recette', [EtatController::class, 'depense_recette'])->name('depense_recette');

    Route::resource('module_utilisateur', UserController::class);
    Route::post('change_password/{id}', [UserController::class, 'change_password']);
    Route::get('supp_user/{id}', [UserController::class, 'destroy']);

    //------------------ Gestion du personnel et des services ------------------//
    Route::resource('gestion_personnel', PersonnelController::class);

    Route::resource('gestion_service', ServiceController::class);

    Route::resource('gestion_diligence', DiligenceController::class);

    Route::resource('gestion_critere', CritereController::class);

    Route::resource('gestion_traitement', TraitementController::class);

    Route::resource('gestion_entete', EnteteController::class);

    Route::resource('gestion_marche', MarcheController::class);
    // print marche
    Route::get('print_marche/{id}', [MarcheController::class, 'print_marche'])->name('print_marche');

    Route::get('gestion_etat', [PageController::class, 'etat'])->name('etat');

    // ------------------ gestion des etats ------------------//
    Route::get('etat/solde_client', [EtatController::class, 'solde_client'])->name('solde_client');
    Route::get('etat/solde_fournisseur', [EtatController::class, 'solde_fournisseur'])->name('solde_fournisseur');
    Route::get('etat/marche_global', [EtatController::class, 'marche_global'])->name('marche_global');
    Route::get('etat/marche_detaille', [EtatController::class, 'marche_detaille'])->name('marche_detaille');
    Route::get('etat/facture_par_categorie', [EtatController::class, 'facture_categorie'])->name('facture_par_categorie');
    Route::get('etat/facture_par_departement', [EtatController::class, 'facture_departement'])->name('facture_par_departement');

    // Print des etats
    Route::get('etat/print_solde_client', [EtatController::class, 'print_solde_client'])->name('print_solde_client');
    Route::get('etat/print_solde_fournisseur', [EtatController::class, 'print_solde_fournisseur'])->name('print_solde_fournisseur');
    Route::get('etat/print_etat_marche', [EtatController::class, 'print_etat_marche'])->name('print_etat_marche');
    Route::get('etat/print_detail_marche', [EtatController::class, 'print_detail_marche'])->name('print_detail_marche');
    Route::get('etat/print_etat_categorie', [EtatController::class, 'print_etat_categorie'])->name('print_etat_categorie');
    Route::get('etat/print_etat_departement', [EtatController::class, 'print_etat_departement'])->name('print_etat_departement');
});
