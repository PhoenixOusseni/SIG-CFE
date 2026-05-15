<?php

namespace App\Http\Controllers;

use App\Models\FactureFournisseur;
use App\Models\Recette;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;

class PageController extends Controller
{

    public function auth()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        $collection = Recette::where('statut', 'en reglement')->where('users_id', auth()->id())->get();
        $recettes = Recette::where('statut', 'en attente')->where('users_id', auth()->id())->get();

        $currentYear = Carbon::now()->year;

        // Statistiques par ligne de service (nombre de recettes par trimestre)
        $statsService = [
            '1er trim' => Recette::whereBetween('created_at', [Carbon::create($currentYear, 1, 1), Carbon::create($currentYear, 3, 31, 23, 59, 59)])->count() ?? 0,
            '2e trim' => Recette::whereBetween('created_at', [Carbon::create($currentYear, 4, 1), Carbon::create($currentYear, 6, 30, 23, 59, 59)])->count() ?? 0,
            '3e trim' => Recette::whereBetween('created_at', [Carbon::create($currentYear, 7, 1), Carbon::create($currentYear, 9, 30, 23, 59, 59)])->count() ?? 0,
            '4e trim' => Recette::whereBetween('created_at', [Carbon::create($currentYear, 10, 1), Carbon::create($currentYear, 12, 31, 23, 59, 59)])->count() ?? 0,
        ];

        // Statistiques par ligne métier (nombre de marchés par trimestre)
        $statsMetier = [
            '1er trim' => Recette::whereBetween('created_at', [Carbon::create($currentYear, 1, 1), Carbon::create($currentYear, 3, 31, 23, 59, 59)])->distinct('marche_id')->count('marche_id') ?? 0,
            '2e trim' => Recette::whereBetween('created_at', [Carbon::create($currentYear, 4, 1), Carbon::create($currentYear, 6, 30, 23, 59, 59)])->distinct('marche_id')->count('marche_id') ?? 0,
            '3e trim' => Recette::whereBetween('created_at', [Carbon::create($currentYear, 7, 1), Carbon::create($currentYear, 9, 30, 23, 59, 59)])->distinct('marche_id')->count('marche_id') ?? 0,
            '4e trim' => Recette::whereBetween('created_at', [Carbon::create($currentYear, 10, 1), Carbon::create($currentYear, 12, 31, 23, 59, 59)])->distinct('marche_id')->count('marche_id') ?? 0,
        ];

        return view('pages.dashboard.index', compact('collection', 'recettes', 'statsService', 'statsMetier'));
    }
}
