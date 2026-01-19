<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Contribuable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContribuableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Contribuable::all();
        $categories = Categorie::all();

        return view('pages.contribuable.index',compact('collection', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Contribuable::create([
            'assujeti' => $request->assujeti,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'ifu' => $request->ifu,
            'rccm' => $request->rccm,
            'categories_id' => $request->categories_id,
        ]);

        smilify('success','Contribuable ajouté avec succès !');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contribuable  $contribuable
     * @return \Illuminate\Http\Response
     */
    public function show(Contribuable $contribuable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contribuable  $contribuable
     * @return \Illuminate\Http\Response
     */
    public function edit(Contribuable $contribuable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contribuable  $contribuable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contribuable $contribuable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contribuable  $contribuable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contribuable $contribuable)
    {
        //
    }
}
