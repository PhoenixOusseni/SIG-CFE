<?php

namespace App\Http\Controllers;

use App\Models\Famille;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FamilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Famille::paginate(10);
        return view('pages.famille.index',compact('collection'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Famille::create([
            'libelle' => $request->libelle,
            'taux' => $request->taux,
        ]);

        smilify('success','Famille ajoutée avec succès !');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, String $id)
    {
        $famille = Famille::findOrFail($id);
        $famille->update([
            'libelle' => $request->libelle,
            'taux' => $request->taux,
            'code' => $request->code,
        ]);

        smilify('success','Famille mise à jour avec succès !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $id)
    {
        $famille = Famille::findOrFail($id);
        $famille->delete();

        smilify('success','Département supprimé avec succès !');
        return redirect()->back();
    }
}
