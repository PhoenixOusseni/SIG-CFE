<?php

namespace App\Http\Controllers;

use App\Models\BaseTaxable;
use App\Http\Controllers\Controller;
use App\Models\Famille;
use Illuminate\Http\Request;

class BaseTaxableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = BaseTaxable::paginate(10);
        $familles = Famille::all();

        return view('pages.taxable.index',compact('collection', 'familles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        BaseTaxable::create([
            'libelle' => $request->libelle,
            'reference' => $request->reference,
            'prix' => $request->prix,
            'familles_id' => $request->familles_id,
        ]);

        smilify('success','Base taxable ajoutée avec succès !');
        return redirect()->back();
    }

        /**
        * Show the form for editing the specified resource.
        *
        * @param  \App\Models\BaseTaxable  $baseTaxable
        * @return \Illuminate\Http\Response
        */
    public function update(String $id, Request $request)
    {
        $baseTaxable = BaseTaxable::findOrFail($id);
        $baseTaxable->update([
            'libelle' => $request->libelle,
            'reference' => $request->reference,
            'prix' => $request->prix,
            'familles_id' => $request->familles_id,
        ]);

        smilify('success','Base taxable modifiée avec succès !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BaseTaxable  $baseTaxable
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $id)
    {
        $baseTaxable = BaseTaxable::findOrFail($id);
        $baseTaxable->delete();

        smilify('success','Base taxable supprimée avec succès !');
        return redirect()->back();
    }
}
