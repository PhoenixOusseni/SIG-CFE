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
        $collection = FactureFournisseur::where('statut', 'en attente')->get();
        $recettes = Recette::where('statut', 'en attente')->get();

        return view('pages.dashboard.index', compact('collection', 'recettes'));
    }
}
