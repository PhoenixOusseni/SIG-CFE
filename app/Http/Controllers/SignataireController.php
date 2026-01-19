<?php

namespace App\Http\Controllers;

use App\Models\Signataire;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignataireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Signataire::all();
        return view('pages.signataire.index', compact('collection'));
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
        Signataire::create([
            'nom' => $request->nom,
            'fonction' => $request->fonction,
            'photo' => $request->photo->store('images', 'public')
        ]);

        smilify('success','Signataire enregistré avec succès !');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Signataire  $signataire
     * @return \Illuminate\Http\Response
     */
    public function show(Signataire $signataire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Signataire  $signataire
     * @return \Illuminate\Http\Response
     */
    public function edit(Signataire $signataire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Signataire  $signataire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $sign = Signataire::find($id);
        $sign->update([
            'nom' => $request->nom,
            'fonction' => $request->fonction,
            // 'photo' => $request->photo->store('images', 'public')
        ]);

        smilify('success', 'Signataire modifié avec succès !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Signataire  $signataire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signataire $signataire)
    {
        //
    }
}
