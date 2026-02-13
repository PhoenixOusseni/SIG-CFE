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
                                                                    <a href="#" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#validationRecetteModal{{ $recette->id }}">
                                                                        Mise en reglement
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="validationRecetteModal{{ $recette->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-success">
                                                                            <h5 class="modal-title text-light" id="exampleModalLabel">
                                                                                Validation de la recette N° {{ $recette->id }}</h5>
                                                                            <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="POST" action="{{ url('recette_en_reglement/' . $recette->id) }}">
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label class="small mb-1">Retenues</label>
                                                                                            <select name="retenu_bic" class="form-select">
                                                                                                <option value="5">Prestation</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label class="small mb-1">Autres retenues</label>
                                                                                            <input type="text" name="autres_retenu" class="form-control" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="m-3">
                                                                                    <button class="btn btn-1" type="submit">Mettre en règlement</button>
                                                                                </div>
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
