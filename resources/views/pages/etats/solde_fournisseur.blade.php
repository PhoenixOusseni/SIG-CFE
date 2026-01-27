@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Solde Fournisseurs</title>
@endsection

@section('style')
    @include('partials.style')
    <style>
        .filter-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 5px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .filter-card .form-label {
            color: white;
            font-weight: 600;
        }
        .result-card {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .solde-positive {
            color: #28a745;
            font-weight: bold;
        }
        .solde-negative {
            color: #dc3545;
            font-weight: bold;
        }
        .solde-zero {
            color: #6c757d;
            font-weight: bold;
        }
        .stat-box {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <main>
        <header class="page-header page-header-dark header-gradient pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="dollar-sign"></i></div>
                                État des Soldes Fournisseurs
                            </h1>
                            <div class="page-header-subtitle">Consultation et suivi des soldes par fournisseur</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-n10">
            <!-- Formulaire de recherche -->
            <div class="card mb-4">
                <div class="card-body filter-card">
                    <h5 class="mb-4"><i data-feather="filter"></i> Filtres de recherche</h5>
                    <form action="{{ route('solde_fournisseur') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label class="form-label">Fournisseur</label>
                                <select name="fournisseur_id" class="form-select">
                                    <option value="">Tous les fournisseurs</option>
                                    @foreach($fournisseurs as $fournisseur)
                                        <option value="{{ $fournisseur->id }}"
                                            {{ request('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
                                            {{ $fournisseur->libelle }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-3">
                                <label class="form-label">Date début</label>
                                <input type="date" name="date_debut" class="form-control"
                                    value="{{ request('date_debut') }}">
                            </div>

                            <div class="col-lg-3 col-md-6 mb-3">
                                <label class="form-label">Date fin</label>
                                <input type="date" name="date_fin" class="form-control"
                                    value="{{ request('date_fin') }}">
                            </div>

                            <div class="col-lg-2 col-md-6 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-light w-100">
                                    <i data-feather="search"></i> Rechercher
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Statistiques globales -->
            @if($soldes->isNotEmpty())
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-box">
                        <i data-feather="users" style="width: 40px; height: 40px; color: #667eea;"></i>
                        <div class="text-muted">Fournisseurs</div>
                        <div class="stat-value" style="color: #667eea;">{{ $soldes->count() }}</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-box">
                        <i data-feather="file-text" style="width: 40px; height: 40px; color: #f39c12;"></i>
                        <div class="text-muted">Total Factures</div>
                        <div class="stat-value" style="color: #f39c12;">{{ number_format($soldes->sum('total_facture'), 0, ',', ' ') }} FCFA</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-box">
                        <i data-feather="check-circle" style="width: 40px; height: 40px; color: #28a745;"></i>
                        <div class="text-muted">Total Réglé</div>
                        <div class="stat-value" style="color: #28a745;">{{ number_format($soldes->sum('total_regle'), 0, ',', ' ') }} FCFA</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-box">
                        <i data-feather="alert-circle" style="width: 40px; height: 40px; color: #dc3545;"></i>
                        <div class="text-muted">Solde Restant</div>
                        <div class="stat-value" style="color: #dc3545;">{{ number_format($soldes->sum('solde'), 0, ',', ' ') }} FCFA</div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Résultats -->
            <div class="card result-card">
                <div class="card-header bg-primary text-white">
                    <i data-feather="list"></i> Résultats
                    @if($soldes->isNotEmpty())
                        <span class="badge bg-light text-primary float-end">{{ $soldes->count() }} fournisseur(s)</span>
                    @endif
                </div>
                <div class="card-body">
                    @if($soldes->isEmpty())
                        <div class="text-center py-5">
                            <i data-feather="inbox" style="width: 64px; height: 64px; color: #ccc;"></i>
                            <h5 class="mt-3 text-muted">Aucun résultat</h5>
                            <p class="text-muted">Veuillez sélectionner des critères de recherche et cliquer sur "Rechercher"</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="25%">Fournisseur</th>
                                        <th width="15%">Contact</th>
                                        <th width="15%" class="text-end">Total Factures</th>
                                        <th width="15%" class="text-end">Total Réglé</th>
                                        <th width="15%" class="text-end">Solde</th>
                                        <th width="10%" class="text-center">Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($soldes as $index => $solde)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $solde->fournisseur->libelle }}</strong>
                                                @if($solde->fournisseur->ifu)
                                                    <br><small class="text-muted">IFU: {{ $solde->fournisseur->ifu }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($solde->fournisseur->telephone)
                                                    <i data-feather="phone" style="width: 14px; height: 14px;"></i> {{ $solde->fournisseur->telephone }}
                                                @else
                                                    <span class="text-muted">Non renseigné</span>
                                                @endif
                                            </td>
                                            <td class="text-end">{{ number_format($solde->total_facture, 0, ',', ' ') }} FCFA</td>
                                            <td class="text-end">{{ number_format($solde->total_regle, 0, ',', ' ') }} FCFA</td>
                                            <td class="text-end">
                                                <span class="
                                                    @if($solde->solde > 0) solde-negative
                                                    @elseif($solde->solde < 0) solde-positive
                                                    @else solde-zero
                                                    @endif
                                                ">
                                                    {{ number_format($solde->solde, 0, ',', ' ') }} FCFA
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if($solde->solde > 0)
                                                    <span class="badge bg-danger">À payer</span>
                                                @elseif($solde->solde < 0)
                                                    <span class="badge bg-warning">Trop-perçu</span>
                                                @else
                                                    <span class="badge bg-success">Soldé</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-secondary">
                                    <tr>
                                        <th colspan="3" class="text-end">TOTAUX :</th>
                                        <th class="text-end">{{ number_format($soldes->sum('total_facture'), 0, ',', ' ') }} FCFA</th>
                                        <th class="text-end">{{ number_format($soldes->sum('total_regle'), 0, ',', ' ') }} FCFA</th>
                                        <th class="text-end">
                                            <span class="
                                                @if($soldes->sum('solde') > 0) solde-negative
                                                @elseif($soldes->sum('solde') < 0) solde-positive
                                                @else solde-zero
                                                @endif
                                            ">
                                                {{ number_format($soldes->sum('solde'), 0, ',', ' ') }} FCFA
                                            </span>
                                        </th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Bouton d'impression -->
                        <div class="text-end mt-3">
                            <button onclick="window.print()" class="btn btn-secondary">
                                <i data-feather="printer"></i> Imprimer le rapport
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
<script>
    // Initialiser les icônes Feather
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

    // Style d'impression
    window.addEventListener('beforeprint', function() {
        document.querySelector('.filter-card').style.display = 'none';
        document.querySelector('button[onclick="window.print()"]').style.display = 'none';
    });

    window.addEventListener('afterprint', function() {
        document.querySelector('.filter-card').style.display = 'block';
        document.querySelector('button[onclick="window.print()"]').style.display = 'inline-block';
    });
</script>
@endsection
