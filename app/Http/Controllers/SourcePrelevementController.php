<?php

namespace App\Http\Controllers;

use App\Models\SourcePrelevement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SourcePrelevementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = SourcePrelevement::orderBy('created_at','desc')->get();
        return view('pages.prelevement.index',compact('collection'));
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
        $this->validate($request, [
            'libelle' =>    ['required', 'string', 'max:150', 'min:2'],
        ]);

        SourcePrelevement::create([
            'libelle' => $request->libelle,
            'localisation' => $request->localisation,
        ]);

        smilify('success','Source de prelevement enregistrée avec succès!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SourcePrelevement  $sourcePrelevement
     * @return \Illuminate\Http\Response
     */
    public function show(SourcePrelevement $sourcePrelevement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SourcePrelevement  $sourcePrelevement
     * @return \Illuminate\Http\Response
     */
    public function edit(SourcePrelevement $sourcePrelevement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SourcePrelevement  $sourcePrelevement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SourcePrelevement $sourcePrelevement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SourcePrelevement  $sourcePrelevement
     * @return \Illuminate\Http\Response
     */
    public function destroy(SourcePrelevement $sourcePrelevement)
    {
        //
    }
}
