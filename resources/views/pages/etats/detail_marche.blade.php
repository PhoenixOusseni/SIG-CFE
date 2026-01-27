@extends('layouts.master')

@section('title')
    <title>SIG - CFE | État des factures par marché</title>
@endsection

@section('style')
    @include('partials.style')
    <style>
        .filter-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
            border-left: 4px solid #28a745;
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

        .table-factures {
            margin-top: 20px;
        }

        .table-factures thead {
            background: #343a40;
            color: white;
        }

        .table-factures th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            padding: 15px 10px;
            border: none;
        }

        .table-factures td {
            padding: 12px 10px;
            vertical-align: middle;
        }

        .table-factures tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .marche-info-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .marche-info-box h4 {
            margin-bottom: 15px;
            font-weight: bold;
        }

        .marche-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .marche-detail:last-child {
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
    </style>
@endsection

@section('content')
    <header class="page-header page-header-dark header-gradient pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="file-text"></i></div>
                            État des factures par marché
                        </h1>
                        <div class="page-header-subtitle">Consultez les factures associées aux marchés</div>
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
                <h5 class="mb-0 text-white">
                    <i data-feather="filter"></i> Critères de recherche
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('marche_detaille') }}" method="GET">
                    <div class="row">
                        <!-- Sélection du marché -->
                        <div class="col-md-4 mb-3">
                            <label for="marche_id" class="form-label">Sélectionner un marché</label>
                            <select name="marche_id" id="marche_id" class="form-select">
                                <option value="">-- Tous les marchés --</option>
                                @foreach ($marches as $marche)
                                    <option value="{{ $marche->id }}"
                                        {{ request('marche_id') == $marche->id ? 'selected' : '' }}>
                                        {{ $marche->code }} - {{ $marche->designation }}
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
                            <button type="submit" class="btn btn-light w-100 mb-2">
                                <i data-feather="search"></i> Rechercher
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="{{ route('marche_detaille') }}" class="btn btn-light">
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
                    @foreach ($resultats as $resultat)
                        <!-- Informations du marché -->
                        <div class="marche-info-box">
                            <h4>
                                <i data-feather="briefcase"></i> {{ $resultat->marche->code }} -
                                {{ $resultat->marche->designation }}
                            </h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="marche-detail">
                                        <span>Client :</span>
                                        <strong>{{ $resultat->marche->contribuable->assujeti ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="marche-detail">
                                        <span>Montant du marché :</span>
                                        <strong>{{ number_format($resultat->marche->montant, 0, ',', ' ') }} FCFA</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="marche-detail">
                                        <span>Date début :</span>
                                        <strong>{{ $resultat->marche->date_debut ? \Carbon\Carbon::parse($resultat->marche->date_debut)->format('d/m/Y') : 'N/A' }}</strong>
                                    </div>
                                    <div class="marche-detail">
                                        <span>Date clôture :</span>
                                        <strong>{{ $resultat->marche->date_cloture ? \Carbon\Carbon::parse($resultat->marche->date_cloture)->format('d/m/Y') : 'N/A' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistiques -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-label">Nombre de factures</div>
                                    <div class="stats-value primary">{{ $resultat->factures->count() }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-label">Total facturé</div>
                                    <div class="stats-value success">
                                        {{ number_format($resultat->total_facture, 0, ',', ' ') }} FCFA
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-label">Total réglé</div>
                                    <div class="stats-value">
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

                        <!-- Table des factures -->
                        @if ($resultat->factures->count() > 0)
                            <div class="table-responsive table-factures">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">#</th>
                                            <th style="width: 12%;">Date</th>
                                            <th style="width: 25%;">Fournisseur</th>
                                            <th style="width: 20%;">Objet</th>
                                            <th style="width: 12%;">Montant HT</th>
                                            <th style="width: 8%;">TVA</th>
                                            <th style="width: 12%;">Montant TTC</th>
                                            <th style="width: 10%;">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalHT = 0;
                                            $totalTVA = 0;
                                            $totalTTC = 0;
                                        @endphp
                                        @foreach ($resultat->factures as $index => $facture)
                                            @php
                                                $montantHT = $facture->ElementFacture->sum('montant_total');
                                                $montantTVA = ($montantHT * $facture->tva) / 100;
                                                $montantTTC = $montantHT + $montantTVA;
                                                $totalHT += $montantHT;
                                                $totalTVA += $montantTVA;
                                                $totalTTC += $montantTTC;
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($facture->date)->format('d/m/Y') }}</td>
                                                <td>
                                                    <strong>{{ $facture->Fournisseur->libelle ?? 'N/A' }}</strong>
                                                </td>
                                                <td>{{ $facture->objet ?? 'Non précisé' }}</td>
                                                <td class="text-end">{{ number_format($montantHT, 0, ',', ' ') }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-info">{{ $facture->tva ?? 0 }}%</span>
                                                </td>
                                                <td class="text-end"><strong>{{ number_format($montantTTC, 0, ',', ' ') }}</strong></td>
                                                <td class="text-center">
                                                    @if ($facture->statut == 'en_attente')
                                                        <span class="badge-status bg-warning text-dark">En attente</span>
                                                    @elseif($facture->statut == 'validee')
                                                        <span class="badge-status bg-success">Validée</span>
                                                    @elseif($facture->statut == 'en_reglement')
                                                        <span class="badge-status bg-info">En règlement</span>
                                                    @elseif($facture->statut == 'reglee')
                                                        <span class="badge-status bg-primary">Réglée</span>
                                                    @else
                                                        <span class="badge-status bg-secondary">{{ $facture->statut }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- Ligne de total -->
                                        <tr class="summary-row">
                                            <td colspan="4" class="text-end"><strong>TOTAL</strong></td>
                                            <td class="text-end">{{ number_format($totalHT, 0, ',', ' ') }}</td>
                                            <td></td>
                                            <td class="text-end">{{ number_format($totalTTC, 0, ',', ' ') }}</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info mt-3">
                                <i data-feather="info"></i> Aucune facture fournisseur associée à ce marché pour la
                                période sélectionnée.
                            </div>
                        @endif

                        @if (!$loop->last)
                            <hr class="my-5">
                        @endif
                    @endforeach
                </div>
            </div>
        @elseif(request()->has('marche_id') || request()->has('date_debut') || request()->has('date_fin'))
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
                        <p>Sélectionnez un marché et/ou une période pour afficher les factures associées.</p>
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
