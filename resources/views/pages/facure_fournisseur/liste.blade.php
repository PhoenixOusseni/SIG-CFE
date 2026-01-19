@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Facture fournisseurs</title>
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
                                Liste des Facture fournisseurs
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
                            <a href="{{ route('all_facture') }}" class="btn btn-primary">
                                Tous les factures
                            </a>
                            <a href="{{ route('entente_facture') }}" class="btn btn-warning">
                                Factures en attentes
                            </a>
                            <a href="{{ route('valide_facture') }}" class="btn btn-secondary">
                                Factures validées
                            </a>
                            <a href="{{ route('reglem_fact') }}" class="btn btn-1">
                                Factures mis en reglement
                            </a>
                            <a href="{{ route('regle_fact') }}" class="btn btn-danger">
                                Factures reglées
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
                                                            <th>N°</th>
                                                            <th>Date</th>
                                                            <th>Budget</th>
                                                            <th>Fournisseur</th>
                                                            <th>Statut</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($collection as $fact)
                                                            <tr>
                                                                <td>{{ $fact->id }}</td>
                                                                <td>{{ $fact->date }}</td>
                                                                <td>{{ $fact->Budget->libelle }}</td>
                                                                <td>{{ $fact->Fournisseur->libelle }}</td>
                                                                <td>{{ $fact->statut }}</td>
                                                                <td class="d-flex justify-content-center">
                                                                    <a href="{{ route ('module_facture_fournisseur.show', [$fact->id]) }}">
                                                                        <i class="fa fa-eye text-success" aria-hidden="true"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
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
