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
                                Gestion des factures
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Tabbed dashboard card example-->
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="sbp-preview-content">
                                                <table class="table table-bordered table-hover table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Référence</th>
                                                            <th>Date</th>
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
                                                                <td>{{ $recette->date }}</td>
                                                                <td>{{ $recette->Contribuable->assujeti }}</td>
                                                                <td>{{ $recette->echeance }}</td>
                                                                <td>{{ $recette->statut }}</td>
                                                                <td class="d-flex justify-content-center">
                                                                    <a href="{{ url('view_reglement/' . $recette->id) }}" class="btn btn-success btn-sm me-2">
                                                                        Reglement
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
