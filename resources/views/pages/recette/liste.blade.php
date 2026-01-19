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
                                Liste des ordre de recette
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
                                Tous les recette
                            </a>
                            <a href="{{ route('entente_recette') }}" class="btn btn-warning">
                                Recette en attente
                            </a>
                            <a href="{{ route('valide_rectte') }}" class="btn btn-secondary">
                                Recette validé
                            </a>
                            <a href="{{ route('reglement_rectte') }}" class="btn btn-1">
                                Recette mis en reglement
                            </a>
                            <a href="{{ route('regle_recette') }}" class="btn btn-danger">
                                Recette reglés
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
                                                            <th>Designation</th>
                                                            <th>Date</th>
                                                            <th>Budget</th>
                                                            <th>Contribuable</th>
                                                            <th>Echeance</th>
                                                            <th>Statut</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($collection as $recette)
                                                            <tr>
                                                                <td>{{ $recette->id }}</td>
                                                                <td>{{ $recette->objet }}</td>
                                                                <td>{{ $recette->date }}</td>
                                                                <td>{{ $recette->Budget->libelle }}</td>
                                                                <td>{{ $recette->Contribuable->assujeti }}</td>
                                                                <td>{{ $recette->echeance }}</td>
                                                                <td>{{ $recette->statut }}</td>
                                                                <td class="d-flex justify-content-center">
                                                                    <a href="{{ route ('module_ordre_recette.show', [$recette->id]) }}">
                                                                        <i class="fa fa-eye text-success" aria-hidden="true"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @include('pages.recette.view_recette_modal')
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
