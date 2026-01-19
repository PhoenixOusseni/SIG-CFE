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
                <div class="card-header">Ajouter un ordres de recette</div>
                <div class="card-body">

                    <form action="{{ route('module_ordre_recette.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-default">
                            <div class="card-body">
                                <fieldset class="w-100 p-2" style="border-radius: 5px; background: rgb(234, 233, 233)">
                                    <div class="row">
                                        <input class="form-control" name="statut" type="text" value="en attente" hidden />
                                        <input class="form-control" name="users_id" type="text" value="{{ Auth::user()->id }}" hidden />
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Budget</label>
                                                <select name="budgets_id" class="form-select">
                                                    <option>Sélectionner le budget</option>
                                                    @foreach ($budgets as $budget)
                                                        <option value="{{ $budget->id }}">{{ $budget->libelle }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Contribuable</label>
                                                <select name="contribuables_id" class="form-select">
                                                    <option value="">Sélectionner le contribuable</option>
                                                    @foreach ($contribuables as $contribuable)
                                                        <option value="{{ $contribuable->id }}">{{ $contribuable->assujeti }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Echeance de paiement</label>
                                                <input class="form-control" type="date" name="echeance" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Objet</label>
                                                <input class="form-control" name="objet" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Date</label>
                                                <input class="form-control" name="date" type="date" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Période debut</label>
                                                <input class="form-control" name="periode_debut" type="date" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Période fin</label>
                                                <input class="form-control" name="periode_fin" type="date" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Signataire</label>
                                                <select name="signataires_id" class="form-select">
                                                    <option>Sélectionner le signataire</option>
                                                    @foreach (App\Models\Signataire::all() as $signataire)
                                                        <option value="{{ $signataire->id }}">{{ $signataire->nom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="m-3">
                                <button class="btn btn-1" type="submit">
                                    <i class="fas fa-plus"></i>
                                    &nbsp; &nbsp;Ajouter un ligne
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


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
                                                            <th>Code</th>
                                                            <th>Designation</th>
                                                            <th>Date</th>
                                                            <th>Budget</th>
                                                            <th>Contribuable</th>
                                                            <th>Echeance</th>
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
