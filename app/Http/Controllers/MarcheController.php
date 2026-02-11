<?php

namespace App\Http\Controllers;

use App\Models\Marche;
use App\Models\MarcheDetail;
use App\Models\Contribuable;
use App\Models\Personnel;
use App\Models\BaseTaxable;
use App\Models\Categorie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MarcheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marches = Marche::paginate(10);
        return view('pages.marche.index', compact('marches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Contribuable::all();
        $personnels = Personnel::all();
        $prestations = BaseTaxable::all();
        return view('pages.marche.create', compact('clients', 'personnels', 'prestations'));
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

            // Préparer les données du marché
            $marcheData = [
                'code' => $request->code,
                'designation' => $request->designation,
                'montant' => $request->montant,
                'contribuable_id' => $request->contribuable_id,
                'date_debut' => $request->date_debut,
                'date_cloture' => $request->date_cloture,
                'base_taxable_id' => $request->base_taxable_id,
            ];

            // Gestion des fichiers PJ
            if ($request->hasFile('pj1')) {
                $file = $request->file('pj1');
                $filename = time() . '_pj1_' . $file->getClientOriginalName();
                $file->move(public_path('storage/marches'), $filename);
                $marcheData['pj1'] = 'storage/marches/' . $filename;
            }

            if ($request->hasFile('pj2')) {
                $file = $request->file('pj2');
                $filename = time() . '_pj2_' . $file->getClientOriginalName();
                $file->move(public_path('storage/marches'), $filename);
                $marcheData['pj2'] = 'storage/marches/' . $filename;
            }

            if ($request->hasFile('pj3')) {
                $file = $request->file('pj3');
                $filename = time() . '_pj3_' . $file->getClientOriginalName();
                $file->move(public_path('storage/marches'), $filename);
                $marcheData['pj3'] = 'storage/marches/' . $filename;
            }

            // Créer le marché
            $marche = Marche::create($marcheData);

            // Ajouter les membres de l'équipe (personnels)
            if ($request->has('personnel_id') && is_array($request->personnel_id)) {
                foreach ($request->personnel_id as $index => $personnelId) {
                    if (!empty($personnelId)) {
                        MarcheDetail::create([
                            'marche_id' => $marche->id,
                            'personnel_id' => $personnelId,
                            'temps' => $request->temps[$index] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();

            // Message de succès et redirection
            notify()->success('Marché créé avec succès !');
            return redirect()->route('gestion_marche.index');

        } catch (\Exception $e) {
            DB::rollBack();

            // Supprimer les fichiers téléchargés en cas d'erreur
            if (isset($marcheData['pj1']) && file_exists(public_path($marcheData['pj1']))) {
                unlink(public_path($marcheData['pj1']));
            }
            if (isset($marcheData['pj2']) && file_exists(public_path($marcheData['pj2']))) {
                unlink(public_path($marcheData['pj2']));
            }
            if (isset($marcheData['pj3']) && file_exists(public_path($marcheData['pj3']))) {
                unlink(public_path($marcheData['pj3']));
            }

            notify()->error('Erreur lors de la création du marché : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marche  $marche
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {
        $marcheFind = Marche::with('contribuable', 'details.personnel')->findOrFail($id);
        return view('pages.marche.show', compact('marcheFind'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marche  $marche
     * @return \Illuminate\Http\Response
     */
    public function edit(String $id)
    {
        $marche = Marche::findOrFail($id);
        $clients = Contribuable::all();
        $personnels = Personnel::all();
        $prestations = BaseTaxable::all();
        return view('pages.marche.edit', compact('marche', 'clients', 'personnels', 'prestations'));
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
        try {
            DB::beginTransaction();

            $marche = Marche::findOrFail($id);

            // Mettre à jour les données du marché
            $marche->code = $request->code;
            $marche->designation = $request->designation;
            $marche->montant = $request->montant;
            $marche->contribuable_id = $request->contribuable_id;
            $marche->base_taxable_id = $request->base_taxable_id;
            $marche->date_debut = $request->date_debut;
            $marche->date_cloture = $request->date_cloture;

            // Gestion des fichiers PJ
            if ($request->hasFile('pj1')) {
                // Supprimer l'ancien fichier si existe
                if ($marche->pj1 && file_exists(public_path($marche->pj1))) {
                    unlink(public_path($marche->pj1));
                }
                $file = $request->file('pj1');
                $filename = time() . '_pj1_' . $file->getClientOriginalName();
                $file->move(public_path('storage/marches'), $filename);
                $marche->pj1 = 'storage/marches/' . $filename;
            }

            if ($request->hasFile('pj2')) {
                if ($marche->pj2 && file_exists(public_path($marche->pj2))) {
                    unlink(public_path($marche->pj2));
                }
                $file = $request->file('pj2');
                $filename = time() . '_pj2_' . $file->getClientOriginalName();
                $file->move(public_path('storage/marches'), $filename);
                $marche->pj2 = 'storage/marches/' . $filename;
            }
            if ($request->hasFile('pj3')) {
                if ($marche->pj3 && file_exists(public_path($marche->pj3))) {
                    unlink(public_path($marche->pj3));
                }
                $file = $request->file('pj3');
                $filename = time() . '_pj3_' . $file->getClientOriginalName();
                $file->move(public_path('storage/marches'), $filename);
                $marche->pj3 = 'storage/marches/' . $filename;
            }
            $marche->save();

            // Mise à jour des membres de l'équipe (personnels)
            // Supprimer les anciens détails
            MarcheDetail::where('marche_id', $marche->id)->delete();

            // Ajouter les nouveaux détails
            if ($request->has('personnel_id') && is_array($request->personnel_id)) {
                foreach ($request->personnel_id as $index => $personnelId) {
                    if (!empty($personnelId)) {
                        MarcheDetail::create([
                            'marche_id' => $marche->id,
                            'personnel_id' => $personnelId,
                            'temps' => $request->temps[$index] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();
            notify()->success('Marché mis à jour avec succès !');
            return redirect()->route('gestion_marche.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour du marché.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marche  $marche
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $id)
    {
        $marche = Marche::findOrFail($id);

        // Supprimer les fichiers PJ
        if ($marche->pj1 && file_exists(public_path($marche->pj1))) {
            unlink(public_path($marche->pj1));
        }
        if ($marche->pj2 && file_exists(public_path($marche->pj2))) {
            unlink(public_path($marche->pj2));
        }
        if ($marche->pj3 && file_exists(public_path($marche->pj3))) {
            unlink(public_path($marche->pj3));
        }

        // Supprimer les détails associés
        MarcheDetail::where('marche_id', $marche->id)->delete();

        // Supprimer le marché
        $marche->delete();

        notify()->success('Marché supprimé avec succès !');
        return redirect()->route('gestion_marche.index');
    }

    // Fonction pour imprimer le marché
    public function print_marche($id)
    {
        $marcheFind = Marche::with('contribuable', 'details.personnel')->findOrFail($id);
        return view('pages.marche.print', compact('marcheFind'));
    }
}

