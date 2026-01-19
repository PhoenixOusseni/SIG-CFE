<?php

namespace App\Providers;

use App\Models\ElementFacture;
use App\Models\ElementRecette;
use App\Models\ReglementFacture;
use App\Models\User;
use App\Models\Service;
use App\Models\Diligence;
use App\Models\Critere;
use App\Models\Traitement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ElementRecette::created(function ($elemnt) {
            $elemnt->update(['montant' => $elemnt->quantite * $elemnt->prix_unitaire]);
        });

        ElementFacture::created(function ($elemnt) {
            $elemnt->update(['montant_total' => $elemnt->quantite * $elemnt->prix_unitaire]);
        });

        ReglementFacture::created(function ($regle) {
            $regle->update(['reste' => $regle->net - $regle->versement]);
        });

        User::created(function ($users) {
            $users->update(['login' => $users->nom. '.' . $users->prenom]);
            $users->update(['password' => Hash::make('password')]);
        });


        Service::created(function (Service $service) {
            // Compter combien d'utilisateurs ont déjà été créés
            $count = Service::count();

            // Générer le numéro formaté
            $number = str_pad($count, 3, '0', STR_PAD_LEFT);

            // Construire le code
            $code = "SRV-{$number}";

            // Mettre à jour le service
            $service->update(['code' => $code]);
        });

        Diligence::created(function (Diligence $diligence) {
            // Compter combien d'utilisateurs ont déjà été créés
            $count = Diligence::count();

            // Générer le numéro formaté
            $number = str_pad($count, 3, '0', STR_PAD_LEFT);

            // Construire le code
            $code = "DLG-{$number}";

            // Mettre à jour le diligence
            $diligence->update(['code' => $code]);
        });

        Critere::created(function (Critere $critere) {
            // Compter combien d'utilisateurs ont déjà été créés
            $count = Critere::count();

            // Générer le numéro formaté
            $number = str_pad($count, 3, '0', STR_PAD_LEFT);

            // Construire le code
            $code = "CRT-{$number}";

            // Mettre à jour le critère
            $critere->update(['code' => $code]);
        });

        Traitement::created(function (Traitement $traitement) {
            // Compter combien d'utilisateurs ont déjà été créés
            $count = Traitement::count();

            // Générer le numéro formaté
            $number = str_pad($count, 3, '0', STR_PAD_LEFT);

            // Construire le code
            $code = "TRT-{$number}";

            // Mettre à jour le traitement
            $traitement->update(['code' => $code]);
        });
    }
}
