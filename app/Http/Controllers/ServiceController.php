<?php

namespace App\Http\Controllers;

use App\Models\Service;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('pages.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'libelle' => 'required',
        //     'description' => 'nullable',
        // ]);

        Service::create(
            [
                'libelle' => $request->libelle,
                'description' => $request->description,
            ]
        );

        return redirect()->route('gestion_service.index')
            ->with('success', 'Service créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $finds = Service::findOrFail($id);
        return view('pages.services.edit', compact('finds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $service = Service::findOrFail($id);
        $service->update(
            [
                'libelle' => $request->libelle,
                'description' => $request->description,
            ]
        );

        return redirect()->route('gestion_service.index')
            ->with('success', 'Service modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('gestion_service.index')->with('success', 'Service supprimé avec succès.');
    }
}
