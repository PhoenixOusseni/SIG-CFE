@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Ordre de recette</title>
@endsection

@section('style')
    @include('partials.style')
@endsection

@section('content')
    <main>
        <header class="page-header page-header-dark header-gradient pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Gestion des ordres de recettes
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->

        <div class="container-xl px-4 mt-n10" style="margin-bottom: 8rem;">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">
                    <a href="#" class="btn btn-1" data-bs-toggle="modal" data-bs-target="#addElementModal">
                        <i class="fas fa-plus"></i>
                        &nbsp; &nbsp; Ajouter une ligne
                    </a>
                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="fas fa-edit"></i>
                        &nbsp; &nbsp; Modifier
                    </a>
                    <a href="{{ url('print_ordre_recette/' . $recette->id) }}" class="btn btn-secondary">
                        <i class="fas fa-print"></i>
                        &nbsp; &nbsp; Imprimer
                    </a>
                    <a href="{{ url('supp_ordre_recette/' . $recette->id) }}" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        &nbsp; &nbsp; Supprimer
                    </a>
                </div>
                <div class="card-body">
                    <div class="card card-default">
                        <div class="card-body">
                            <fieldset class="w-100 p-2" style="border-radius: 5px; background: rgb(234, 233, 233)">
                                <div class="row">
                                    <input class="form-control" name="statut" type="text" value="en attente" hidden />
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">N° ordre de recette</label>
                                            <input class="form-control" value="{{ $recette->id }}" type="text" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Budget</label>
                                            <input class="form-control" type="text" value="{{ $recette->Budget->libelle }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Contribuable</label>
                                            <input class="form-control" type="text" value="{{ $recette->Contribuable->assujeti }}" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Objet</label>
                                            <input class="form-control" type="text" value="{{ $recette->objet }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Date</label>
                                            <input class="form-control" value="{{ $recette->date }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Période</label>
                                            <input class="form-control" value="{{ $recette->periode }}" readonly />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="sbp-preview-content">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Designation</th>
                                            <th>Source prelevement</th>
                                            <th>Unité</th>
                                            <th>Qte</th>
                                            <th>P.Unitaire</th>
                                            <th>P.Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($elements as $elmnt)
                                            <tr>
                                                <td>{{ $elmnt->Base->libelle }}</td>
                                                <td>{{ $elmnt->Source->libelle }}</td>
                                                <td>{{ $elmnt->unite }}</td>
                                                <td>{{ $elmnt->quantite }}</td>
                                                <td>{{ $elmnt->prix_unitaire }}</td>
                                                <td>{{ $elmnt->montant }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ url('supp_element_recette/' . $elmnt->id) }}" class="text-danger">
                                                        X
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-light bg-secondary">
                                            <th>Montant total</th>
                                            <th>{{ number_format($montant_total, 0, ',', ' ') }} FCFA</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.recette.add_element_modal')
        @include('pages.recette.editRecette_modal')
    </main>
@endsection
