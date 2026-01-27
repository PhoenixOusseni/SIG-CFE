@extends('layouts.master')

@section('title')
    <title>SIG - CFE | État des recettes par département</title>
@endsection

@section('style')
    @include('partials.style')
    <style>
        .filter-card {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .filter-card .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        .filter-card .card-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 600;
            color: white;
            margin-bottom: 8px;
        }

        .form-select,
        .form-control {
            border-radius: 8px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 10px 15px;
            transition: all 0.3s;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #fff;
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        }

        .btn-search {
            background: #28a745;
            border: none;
            padding: 12px 40px;
            border-radius: 8px;
            font-weight: bold;
            color: white;
            transition: all 0.3s;
        }

        .btn-search:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-reset {
            background: #6c757d;
            border: none;
            padding: 12px 40px;
            border-radius: 8px;
            font-weight: bold;
            color: white;
            transition: all 0.3s;
        }

        .btn-reset:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .result-card {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: none;
            margin-top: 30px;
        }

        .result-card .card-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border-left: 4px solid #4facfe;
        }

        .stats-label {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .stats-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #212529;
        }

        .stats-value.success {
            color: #28a745;
        }

        .stats-value.primary {
            color: #007bff;
        }

        .stats-value.warning {
            color: #ffc107;
        }

        .stats-value.info {
            color: #17a2b8;
        }

        .table-recettes {
            margin-top: 20px;
        }

        .table-recettes thead {
            background: #343a40;
            color: white;
        }

        .table-recettes th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            padding: 15px 10px;
            border: none;
        }

        .table-recettes td {
            padding: 12px 10px;
            vertical-align: middle;
        }

        .table-recettes tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .service-info-box {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .service-info-box h4 {
            margin-bottom: 15px;
            font-weight: bold;
        }

        .service-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .service-detail:last-child {
            border-bottom: none;
        }

        .no-data-message {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .no-data-message i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .summary-row {
            background-color: #e9ecef;
            font-weight: bold;
            font-size: 1.05rem;
        }

        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .progress-bar-custom {
            height: 30px;
            border-radius: 5px;
            background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
        }
    </style>
@endsection

@section('content')
    <header class="page-header page-header-dark header-gradient pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                            État des recettes par département
                        </h1>
                        <div class="page-header-subtitle">Analysez les recettes par service/département</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <!-- Formulaire de filtrage -->
        <div class="card filter-card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i data-feather="filter"></i> Critères de recherche
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('facture_par_departement') }}" method="GET">
                    <div class="row">
                        <!-- Sélection du service -->
                        <div class="col-md-4 mb-3">
                            <label for="service_id" class="form-label">Sélectionner un département/service</label>
                            <select name="service_id" id="service_id" class="form-select">
                                <option value="">-- Tous les départements --</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date de début -->
                        <div class="col-md-3 mb-3">
                            <label for="date_debut" class="form-label">Date de début</label>
                            <input type="date" name="date_debut" id="date_debut" class="form-control"
                                value="{{ request('date_debut') }}">
                        </div>

                        <!-- Date de fin -->
                        <div class="col-md-3 mb-3">
                            <label for="date_fin" class="form-label">Date de fin</label>
                            <input type="date" name="date_fin" id="date_fin" class="form-control"
                                value="{{ request('date_fin') }}">
                        </div>

                        <!-- Boutons d'action -->
                        <div class="col-md-2 mb-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100 mb-2">
                                <i data-feather="search"></i> Rechercher
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="{{ route('facture_par_departement') }}" class="btn btn-primary">
                                <i data-feather="refresh-cw"></i> Réinitialiser
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Résultats -->
        @if (isset($resultats) && $resultats->count() > 0)
            <div class="result-card card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i data-feather="bar-chart-2"></i> Résultats de la recherche
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $grandTotalRecettes = 0;
                        $grandTotalMontant = 0;
                        $grandTotalRegle = 0;
                    @endphp

                    @foreach ($resultats as $resultat)
                        @php
                            $grandTotalRecettes += $resultat->recettes->count();
                            $grandTotalMontant += $resultat->total_montant;
                            $grandTotalRegle += $resultat->total_regle;
                        @endphp

                        <!-- Informations du service -->
                        <div class="service-info-box">
                            <h4>
                                <i data-feather="briefcase"></i> {{ $resultat->service->libelle }}
                            </h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="service-detail">
                                        <span>Nombre de recettes :</span>
                                        <strong>{{ $resultat->recettes->count() }}</strong>
                                    </div>
                                    <div class="service-detail">
                                        <span>Total facturé :</span>
                                        <strong>{{ number_format($resultat->total_montant, 0, ',', ' ') }} FCFA</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="service-detail">
                                        <span>Total réglé :</span>
                                        <strong>{{ number_format($resultat->total_regle, 0, ',', ' ') }} FCFA</strong>
                                    </div>
                                    <div class="service-detail">
                                        <span>Reste à régler :</span>
                                        <strong>{{ number_format($resultat->reste, 0, ',', ' ') }} FCFA</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistiques -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-label">Nombre de recettes</div>
                                    <div class="stats-value primary">{{ $resultat->recettes->count() }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-label">Total facturé</div>
                                    <div class="stats-value success">
                                        {{ number_format($resultat->total_montant, 0, ',', ' ') }} FCFA
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-label">Total réglé</div>
                                    <div class="stats-value info">
                                        {{ number_format($resultat->total_regle, 0, ',', ' ') }} FCFA
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-label">Reste à régler</div>
                                    <div class="stats-value warning">
                                        {{ number_format($resultat->reste, 0, ',', ' ') }} FCFA
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Barre de progression -->
                        @if ($resultat->total_montant > 0)
                            <div class="chart-container">
                                <h6 class="mb-3">Taux de règlement</h6>
                                <div class="progress" style="height: 30px;">
                                    @php
                                        $pourcentageRegle = ($resultat->total_regle / $resultat->total_montant) * 100;
                                    @endphp
                                    <div class="progress-bar progress-bar-custom" role="progressbar"
                                        style="width: {{ $pourcentageRegle }}%"
                                        aria-valuenow="{{ $pourcentageRegle }}" aria-valuemin="0" aria-valuemax="100">
                                        <strong>{{ number_format($pourcentageRegle, 2) }}%</strong>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Table des recettes -->
                        @if ($resultat->recettes->count() > 0)
                            <div class="table-responsive table-recettes">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">#</th>
                                            <th style="width: 12%;">Date</th>
                                            <th style="width: 15%;">N° Ordre</th>
                                            <th style="width: 20%;">Client</th>
                                            <th style="width: 15%;">Catégorie</th>
                                            <th style="width: 12%;">Montant</th>
                                            <th style="width: 11%;">Réglé</th>
                                            <th style="width: 10%;">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalMontant = 0;
                                            $totalRegleTab = 0;
                                        @endphp
                                        @foreach ($resultat->recettes as $index => $recette)
                                            @php
                                                $montantRecette = $recette->ElementRecette->sum('montant');
                                                $montantRegle = $recette->Reglement->sum('versement');
                                                $totalMontant += $montantRecette;
                                                $totalRegleTab += $montantRegle;
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($recette->created_at)->format('d/m/Y') }}</td>
                                                <td><strong>{{ $recette->numero_ordre ?? 'N/A' }}</strong></td>
                                                <td>{{ $recette->Contribuable->assujeti ?? 'N/A' }}</td>
                                                <td>{{ $recette->Categorie->libelle ?? 'N/A' }}</td>
                                                <td class="text-end">
                                                    <strong>{{ number_format($montantRecette, 0, ',', ' ') }}</strong>
                                                </td>
                                                <td class="text-end">{{ number_format($montantRegle, 0, ',', ' ') }}</td>
                                                <td class="text-center">
                                                    @if ($recette->statut == 'en_attente')
                                                        <span class="badge-status bg-warning text-dark">En attente</span>
                                                    @elseif($recette->statut == 'validee')
                                                        <span class="badge-status bg-success">Validée</span>
                                                    @elseif($recette->statut == 'en_reglement')
                                                        <span class="badge-status bg-info">En règlement</span>
                                                    @elseif($recette->statut == 'reglee')
                                                        <span class="badge-status bg-primary">Réglée</span>
                                                    @else
                                                        <span
                                                            class="badge-status bg-secondary">{{ $recette->statut }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- Ligne de total -->
                                        <tr class="summary-row">
                                            <td colspan="5" class="text-end"><strong>TOTAL</strong></td>
                                            <td class="text-end">{{ number_format($totalMontant, 0, ',', ' ') }}</td>
                                            <td class="text-end">{{ number_format($totalRegleTab, 0, ',', ' ') }}</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info mt-3">
                                <i data-feather="info"></i> Aucune recette trouvée pour ce département dans la période
                                sélectionnée.
                            </div>
                        @endif

                        @if (!$loop->last)
                            <hr class="my-5">
                        @endif
                    @endforeach

                    <!-- Récapitulatif général -->
                    @if ($resultats->count() > 1)
                        <div class="chart-container mt-4">
                            <h5 class="mb-4"><i data-feather="trending-up"></i> Récapitulatif général</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-card">
                                        <div class="stats-label">Total des recettes</div>
                                        <div class="stats-value info">{{ $grandTotalRecettes }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stats-card">
                                        <div class="stats-label">Total facturé global</div>
                                        <div class="stats-value success">
                                            {{ number_format($grandTotalMontant, 0, ',', ' ') }} FCFA
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stats-card">
                                        <div class="stats-label">Total réglé global</div>
                                        <div class="stats-value">
                                            {{ number_format($grandTotalRegle, 0, ',', ' ') }} FCFA
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @elseif(request()->has('service_id') || request()->has('date_debut') || request()->has('date_fin'))
            <div class="result-card card">
                <div class="card-body">
                    <div class="no-data-message">
                        <i data-feather="inbox"></i>
                        <h4>Aucun résultat trouvé</h4>
                        <p>Aucune donnée ne correspond aux critères de recherche sélectionnés.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="result-card card">
                <div class="card-body">
                    <div class="no-data-message">
                        <i data-feather="search"></i>
                        <h4>Veuillez effectuer une recherche</h4>
                        <p>Sélectionnez un département et/ou une période pour afficher les recettes associées.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    @include('partials.script')
    <script>
        // Initialiser Feather Icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
@endsection
