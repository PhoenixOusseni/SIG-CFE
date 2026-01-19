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
        $collection = BaseTaxable::all();
        $familles = Famille::all();

        return view('pages.taxable.index',compact('collection', 'familles'));
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
     * Display the specified resource.
     *
     * @param  \App\Models\BaseTaxable  $baseTaxable
     * @return \Illuminate\Http\Response
     */
    public function show(BaseTaxable $baseTaxable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BaseTaxable  $baseTaxable
     * @return \Illuminate\Http\Response
     */
    public function edit(BaseTaxable $baseTaxable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BaseTaxable  $baseTaxable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BaseTaxable $baseTaxable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BaseTaxable  $baseTaxable
     * @return \Illuminate\Http\Response
     */
    public function destroy(BaseTaxable $baseTaxable)
    {
        //
    }
}
