<?php

namespace App\Http\Controllers;

use App\Models\Entete;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnteteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Entete::all();
        return view('pages.entete.index',compact('collection'));
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
        Entete::create([
            'denomination' => $request->denomination,
            'activite' => $request->activite,
            'postale' => $request->postale,
            'telephone' => $request->telephone,
            'fax' => $request->fax,
            'email' => $request->email,
            'pied_page' => $request->pied_page,
            'logo' => $request->logo->store('images', 'public')
        ]);

        smilify('success','Entete enregistrée avec succès !');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entete  $entete
     * @return \Illuminate\Http\Response
     */
    public function show(Entete $entete)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entete  $entete
     * @return \Illuminate\Http\Response
     */
    public function edit(Entete $entete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entete  $entete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entete $entete)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entete  $entete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entete $entete)
    {
        //
    }
}
