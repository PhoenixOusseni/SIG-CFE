@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Facture fournisseur</title>
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
                <div class="card-header">Ajouter une facture fournisseur</div>
                <div class="card-body">
                    <form action="{{ route('module_facture_fournisseur.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card card-default">
                            <div class="card-body">
                                <fieldset class="w-100 p-2" style="border-radius: 5px; background: rgb(234, 233, 233)">
                                    <div class="row">
                                        <input class="form-control" name="statut" type="text" value="en attente" hidden />
                                        <input class="form-control" name="users_id" type="text" value="{{ Auth::user()->id }}" hidden />
                                        <div class="col-lg-5 col-md-12">
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
                                        <div class="col-lg-5 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Fournisseur</label>
                                                <select name="fournisseurs_id" class="form-select">
                                                    <option value="">Sélectionner le fournisseur</option>
                                                    @foreach ($fournisseurs as $fourn)
                                                        <option value="{{ $fourn->id }}">{{ $fourn->libelle }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Date</label>
                                                <input class="form-control" type="date" name="date" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Objet</label>
                                                <input class="form-control" type="objet" name="objet" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">TVA (%)</label>
                                                <input class="form-control" type="number" name="tva" />
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
                                                            <th>N°</th>
                                                            <th>Date</th>
                                                            <th>Budget</th>
                                                            <th>Fournisseur</th>
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
                                                                <td class="d-flex justify-content-center">
                                                                    <a
                                                                        href="{{ route('module_facture_fournisseur.show', [$fact->id]) }}">
                                                                        <i class="fa fa-eye text-success"
                                                                            aria-hidden="true"></i>
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
