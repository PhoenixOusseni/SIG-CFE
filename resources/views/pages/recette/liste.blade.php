@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Facturation</title>
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
                                Liste des factures
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->

        <div class="container-xl px-4 mt-n10">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Tabbed dashboard card example-->
                    <div class="card mb-4">
                        <div class="card-header">
                            <a href="{{ route('all_recette') }}" class="btn btn-primary">
                                Toutes les factures
                            </a>
                            <a href="{{ route('entente_recette') }}" class="btn btn-warning">
                                Factures en attente
                            </a>
                            <a href="{{ route('valide_rectte') }}" class="btn btn-secondary">
                                Factures validées
                            </a>
                            <a href="{{ route('reglement_rectte') }}" class="btn btn-1">
                                Factures mises en règlement
                            </a>
                            <a href="{{ route('regle_recette') }}" class="btn btn-danger">
                                Facture reglés
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Tabbed dashboard card example-->
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="sbp-preview-content">
                                                <table id="datatablesSimple">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Réference</th>
                                                            <th>Client</th>
                                                            <th>Echeance</th>
                                                            <th>Statut</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($collection as $recette)
                                                            <tr>
                                                                <td>{{ $recette->code }}</td>
                                                                <td>{{ $recette->reference }}</td>
                                                                <td>{{ $recette->Contribuable->assujeti }}</td>
                                                                <td>{{ $recette->echeance }}</td>
                                                                <td>{{ $recette->statut }}</td>
                                                                <td class="d-flex justify-content-between">
                                                                    <a
                                                                        href="{{ route('module_ordre_recette.show', [$recette->id]) }}">
                                                                        <i class="fa fa-eye text-success"
                                                                            aria-hidden="true"></i>
                                                                    </a>
                                                                    <a
                                                                        href="{{ route('module_ordre_recette.edit', [$recette->id]) }}">
                                                                        <i class="fa fa-edit text-warning"
                                                                            aria-hidden="true"></i>
                                                                    </a>
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteRecetteModal{{ $recette->id }}">
                                                                        <i class="fa fa-trash text-danger"
                                                                            aria-hidden="true"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @include('pages.recette.view_recette_modal')
                                                            @include('pages.recette.delet_modal')
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
