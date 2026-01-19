@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Reglement ordre de recette</title>
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
                                Liste des reglements facture fournisseur
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->

        <div class="container-xl px-4 mt-n10" style="margin-bottom: 8rem;">
            <!-- Account details card-->
            <form action="" method="POST">
                <div class="card mb-4">
                    <div class="card-header">
                        Liste des reglements facture fournisseur
                    </div>
                    <div class="card-body">
                        <div class="card card-default">
                            <div class="card-body">
                                <div class="sbp-preview-content">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Date</th>
                                                <th>Budget</th>
                                                <th>Fournisseur</th>
                                                <th>Net à payer</th>
                                                <th>Versement</th>
                                                <th>Reste à payer</th></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($collection as $regle)
                                                <tr>
                                                    <td>{{ $regle->id }}</td>
                                                    <td>{{ $regle->date }}</td>
                                                    <td>{{ $regle->FactureFournisseur->Budget->libelle }}</td>
                                                    <td>{{ $regle->FactureFournisseur->Fournisseur->libelle }}</td>
                                                    <td>{{ number_format($regle->net, 0, ',', ' ') }}</td>
                                                    <td>{{ number_format($regle->versement, 0, ',', ' ') }}</td>
                                                    <td>{{ number_format($regle->reste, 0, ',', ' ') }}</td>
                                                    <td class="d-flex justify-content-between">
                                                        <a href="{{ route('module_reglement_fournisseur.show', [$regle->id]) }}">
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
            </form>
        </div>
    </main>
@endsection
