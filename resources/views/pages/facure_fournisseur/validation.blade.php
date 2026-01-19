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
                                                <table id="datatablesSimple">
                                                    <thead>
                                                        <tr>
                                                            <th>N°</th>
                                                            <th>Date</th>
                                                            <th>Fournisseur</th>
                                                            <th>Budget</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($collection as $facture)
                                                            <tr>
                                                                <td>{{ $facture->id }}</td>
                                                                <td>{{ $facture->date }}</td>
                                                                <td>{{ $facture->Fournisseur->libelle }}</td>
                                                                <td>{{ $facture->Budget->libelle }}</td>
                                                                <td class="d-flex justify-content-center">
                                                                    <a href="#" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#validationFactModal{{ $facture->id }}">
                                                                        Valider
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="validationFactModal{{ $facture->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-success">
                                                                            <h5 class="modal-title text-light" id="exampleModalLabel">
                                                                                Validation de la facture N° {{ $facture->id }}</h5>
                                                                            <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h5>Voulez-vous vraiment valider cette facture ?</h5>
                                                                            <form method="POST" action="{{ url('validation/' . $facture->id) }}">
                                                                                @csrf
                                                                                <button class="btn btn-1 p-3 mt-3 w-100" type="submit">
                                                                                    {{ __('Confirmer') }}
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
