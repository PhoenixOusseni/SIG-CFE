@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Etat dépense - recette</title>
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
                                Etat dépense - recette
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
                            <div class="sbp-preview-content mt-3">
                                <table class="table table-bordered border-dark">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Libelle</th>
                                            <th>Dotation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="background: #e0dddd">
                                            <td>BU{{ $recettes->id }}</td>
                                            <td>{{ $recettes->libelle }}</td>
                                            <td>{{ number_format($recettes->dotation, 0, ',', ' ') }}</td>
                                            <td>{{ number_format($somme_element, 0, ',', ' ') }}</td>
                                        </tr>
                                        @foreach ($recettes->ElementRecette as $item)
                                            <tr>
                                                <td colspan="2">{{ $item->objet }}</td>
                                                <td>{{ number_format($item->ElementRecette->sum('montant_total'), 0, ',', ' ') }}</td>
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
    </main>
@endsection
