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
                                Réglement de la facture N° {{ $factures->id }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->

        <div class="container-xl px-4 mt-n10" style="margin-bottom: 8rem;">
            <!-- Account details card-->
            <form action="{{ route('module_reglement_fournisseur.update', [$factures->id]) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card mb-4">
                    <div class="card-header">
                        <button type="submit" class="btn btn-1">
                            Valider le réglement
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="card card-default">
                            <div class="card-body">
                                <fieldset class="w-100 p-2" style="border-radius: 5px; background: rgb(234, 233, 233)">
                                    <div class="row">
                                        <input class="form-control" name="facture_fournisseurs_id" type="text" value="{{ $factures->id }}" hidden />
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Date de reglement</label>
                                                <input class="form-control" name="date" type="date" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Net à payer</label>
                                                <input class="form-control" name="net" type="number" value="{{ $total_ttc }}" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Versement</label>
                                                <input class="form-control" name="versement" type="number" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Mode de reglement</label>
                                                <select name="mode_reglement" class="form-control">
                                                    <option value="Espèce">Espèce</option>
                                                    <option value="Chèque">Chèque</option>
                                                    <option value="Virement">Virement</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="sbp-preview-content">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Designation</th>
                                                <th>Qte</th>
                                                <th>P.Unitaire</th>
                                                <th>P.Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($elements as $elmnt)
                                                <tr>
                                                    <td>{{ $elmnt->id }}</td>
                                                    <td>{{ $elmnt->designation }}</td>
                                                    <td>{{ $elmnt->quantite }}</td>
                                                    <td>{{ number_format($elmnt->prix_unitaire, 0, ',', ' ') }}</td>
                                                    <td>{{ number_format($elmnt->montant_total, 0, ',', ' ') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row m-1">
                                        <div class="col-lg-9 col-md-6 p-3" style="background: rgb(50, 49, 49)">
                                            <h4 class="text-light"><strong>NET A PAYER</strong></h4>
                                        </div>
                                        <div class="col-lg-3 col-md-6 p-3 bg-danger">
                                            <h4 class="text-light"><strong>{{ number_format($total_ttc, 0, ',', ' ') }} FCFA</strong></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
