@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Solde client</title>
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
                                <div class="page-header-icon"><i data-feather="user-check"></i></div>
                                Solde des factures par client
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-n10" style="margin-bottom: 8rem;">
            <!-- Formulaire de recherche -->
            <div class="card mb-4">
                <div class="card-header">
                    <i data-feather="filter"></i> Filtrer les soldes clients
                </div>
                <div class="card-body">
                    <form action="{{ route('solde_client') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Client</label>
                                    <select name="contribuable_id" class="form-select">
                                        <option value="">Tous les clients</option>
                                        @foreach ($contribuables as $contribuable)
                                            <option value="{{ $contribuable->id }}"
                                                {{ request('contribuable_id') == $contribuable->id ? 'selected' : '' }}>
                                                {{ $contribuable->assujeti }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Date début</label>
                                    <input class="form-control" name="date_debut" type="date"
                                        value="{{ request('date_debut') }}" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Date fin</label>
                                    <input class="form-control" name="date_fin" type="date"
                                        value="{{ request('date_fin') }}" />
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-12 d-flex align-items-end">
                                <div class="mb-3 w-100">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i data-feather="search"></i>&thinsp; Rechercher
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if(request()->has('contribuable_id') || request()->has('date_debut') || request()->has('date_fin'))
                <!-- Résultats -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>
                            <i data-feather="bar-chart-2"></i> Résultats du solde client
                        </span>
                        <button class="btn btn-sm btn-success" onclick="window.print()">
                            <i data-feather="printer"></i>&thinsp; Imprimer
                        </button>
                    </div>
                    <div class="card-body">
                        @if($soldes->isEmpty())
                            <div class="alert alert-info">
                                <i data-feather="info"></i> Aucune facture trouvée pour les critères sélectionnés.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>IFU</th>
                                            <th>Contact</th>
                                            <th class="text-end">Total Facturé (FCFA)</th>
                                            <th class="text-end">Total Réglé (FCFA)</th>
                                            <th class="text-end">Solde (FCFA)</th>
                                            <th class="text-center">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalFacture = 0;
                                            $totalRegle = 0;
                                            $totalSolde = 0;
                                        @endphp
                                        @foreach($soldes as $solde)
                                            @php
                                                $totalFacture += $solde->total_facture;
                                                $totalRegle += $solde->total_regle;
                                                $totalSolde += $solde->solde;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <strong>{{ $solde->contribuable->assujeti }}</strong>
                                                </td>
                                                <td>{{ $solde->contribuable->ifu }}</td>
                                                <td>{{ $solde->contribuable->telephone }}</td>
                                                <td class="text-end">
                                                    <strong>{{ number_format($solde->total_facture, 0, ',', ' ') }}</strong>
                                                </td>
                                                <td class="text-end">
                                                    <strong class="text-success">{{ number_format($solde->total_regle, 0, ',', ' ') }}</strong>
                                                </td>
                                                <td class="text-end">
                                                    <strong class="text-{{ $solde->solde > 0 ? 'danger' : 'success' }}">
                                                        {{ number_format($solde->solde, 0, ',', ' ') }}
                                                    </strong>
                                                </td>
                                                <td class="text-center">
                                                    @if($solde->solde == 0)
                                                        <span class="badge bg-success">Soldé</span>
                                                    @else
                                                        <span class="badge bg-warning">En cours</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-secondary">
                                        <tr>
                                            <th colspan="3" class="text-end">TOTAUX:</th>
                                            <th class="text-end">{{ number_format($totalFacture, 0, ',', ' ') }}</th>
                                            <th class="text-end">{{ number_format($totalRegle, 0, ',', ' ') }}</th>
                                            <th class="text-end">{{ number_format($totalSolde, 0, ',', ' ') }}</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Statistiques -->
                            <div class="row mt-4">
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body">
                                            <h6 class="card-title">Nombre de clients</h6>
                                            <h3>{{ $soldes->count() }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="card bg-info text-white">
                                        <div class="card-body">
                                            <h6 class="card-title">Total facturé</h6>
                                            <h3>{{ number_format($totalFacture, 0, ',', ' ') }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body">
                                            <h6 class="card-title">Total réglé</h6>
                                            <h3>{{ number_format($totalRegle, 0, ',', ' ') }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="card bg-{{ $totalSolde > 0 ? 'danger' : 'success' }} text-white">
                                        <div class="card-body">
                                            <h6 class="card-title">Solde restant</h6>
                                            <h3>{{ number_format($totalSolde, 0, ',', ' ') }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <i data-feather="info"></i> Veuillez sélectionner au moins un critère de recherche pour afficher les résultats.
                </div>
            @endif
        </div>
    </main>
@endsection

@section('script')
    @include('partials.script')
    <script>
        // Réinitialiser les icônes Feather après le chargement de la page
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
@endsection
