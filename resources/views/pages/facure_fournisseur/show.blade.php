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
                                Gestion des facture fournisseurs
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
                        &nbsp; &nbsp;Ajouter une ligne
                    </a>
                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="fas fa-edit"></i>
                        &nbsp; &nbsp; Modifier
                    </a>
                    <a href="{{ url('print_facture_fourn/' . $factures->id) }}" class="btn btn-secondary">
                        <i class="fas fa-print"></i>
                        &nbsp; &nbsp;Imprimer
                    </a>
                    <a href="{{ url('supp_facture_fournisseur/' . $factures->id) }}" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        &nbsp; &nbsp;Supprimer
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
                                            <label class="small mb-1">Budget</label>
                                            <select name="budgets_id" class="form-control">
                                                <option>Sélectionner le budget</option>
                                                @foreach ($budgets as $budget)
                                                    <option value="{{ $budget->id }}">{{ $budget->libelle }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Fournisseur</label>
                                            <select name="fournisseurs_id" class="form-control">
                                                <option value="">Sélectionner le fournisseur</option>
                                                @foreach ($fournisseurs as $fourn)
                                                    <option value="{{ $fourn->id }}">{{ $fourn->libelle }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Date</label>
                                            <input class="form-control" type="date" name="date" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="sbp-preview-content">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Designation</th>
                                            <th>Qte</th>
                                            <th>P.Unitaire</th>
                                            <th>P.Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($elements as $elmnt)
                                            <tr>
                                                <td>{{ $elmnt->designation }}</td>
                                                <td>{{ $elmnt->quantite }}</td>
                                                <td>{{ number_format($elmnt->prix_unitaire, 0, ',', ' ') }}</td>
                                                <td>{{ number_format($elmnt->montant_total, 0, ',', ' ') }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ url('supp_element_facture_fournisseur/' . $elmnt->id) }}" class="text-danger">
                                                        X
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Total retenues</th>
                                            <th>Total HT</th>
                                            <th>Total TTC</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-success text-white">
                                            <td>{{ number_format($tota_ret, 0, ',', ' ') }} FCFA</td>
                                            <td>{{ number_format($total_ht, 0, ',', ' ') }} FCFA</td>
                                            <td>{{ number_format($total_ttc, 0, ',', ' ') }} FCFA</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.facure_fournisseur.add_element_modal')
    </main>
@endsection
