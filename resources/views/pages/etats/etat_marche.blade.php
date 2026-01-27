@extends('layouts.master')

@section('title')
    <title>SIG - CFE | État des Marchés</title>
@endsection

@section('style')
    @include('partials.style')
    <style>
        .filter-card {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
        .marche-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .marche-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .marche-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
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
        .progress-custom {
            height: 25px;
            border-radius: 15px;
            background-color: #e9ecef;
        }
        .badge-status {
            font-size: 0.85rem;
            padding: 8px 15px;
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
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                État des Marchés
                            </h1>
                            <div class="page-header-subtitle">Consultation et suivi des marchés en cours</div>
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
                    <form action="{{ route('marche_global') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label class="form-label">Marché</label>
                                <select name="marche_id" class="form-select">
                                    <option value="">Tous les marchés</option>
                                    @foreach($marches as $marche)
                                        <option value="{{ $marche->id }}"
                                            {{ request('marche_id') == $marche->id ? 'selected' : '' }}>
                                            {{ $marche->code }} - {{ $marche->designation }}
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
            @if($resultats->isNotEmpty())
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-box">
                        <i data-feather="briefcase" style="width: 40px; height: 40px; color: #11998e;"></i>
                        <div class="text-muted">Total Marchés</div>
                        <div class="stat-value" style="color: #11998e;">{{ $resultats->count() }}</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-box">
                        <i data-feather="dollar-sign" style="width: 40px; height: 40px; color: #667eea;"></i>
                        <div class="text-muted">Montant Total</div>
                        <div class="stat-value" style="color: #667eea;">{{ number_format($resultats->sum('montant'), 0, ',', ' ') }} FCFA</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-box">
                        <i data-feather="check-circle" style="width: 40px; height: 40px; color: #28a745;"></i>
                        <div class="text-muted">Montant Exécuté</div>
                        <div class="stat-value" style="color: #28a745;">{{ number_format($resultats->sum('montant_execute'), 0, ',', ' ') }} FCFA</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-box">
                        <i data-feather="alert-circle" style="width: 40px; height: 40px; color: #ffa502;"></i>
                        <div class="text-muted">Reste à Exécuter</div>
                        <div class="stat-value" style="color: #ffa502;">{{ number_format($resultats->sum('reste'), 0, ',', ' ') }} FCFA</div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Résultats -->
            <div class="card result-card">
                <div class="card-header bg-success text-white">
                    <i data-feather="list"></i> Résultats
                    @if($resultats->isNotEmpty())
                        <span class="badge bg-light text-success float-end">{{ $resultats->count() }} marché(s)</span>
                    @endif
                </div>
                <div class="card-body">
                    @if($resultats->isEmpty())
                        <div class="text-center py-5">
                            <i data-feather="inbox" style="width: 64px; height: 64px; color: #ccc;"></i>
                            <h5 class="mt-3 text-muted">Aucun résultat</h5>
                            <p class="text-muted">Veuillez sélectionner des critères de recherche et cliquer sur "Rechercher"</p>
                        </div>
                    @else
                        @foreach($resultats as $resultat)
                            <div class="marche-card">
                                <div class="marche-header">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h5 class="mb-1"><i data-feather="file-text"></i> {{ $resultat->code }}</h5>
                                            <p class="mb-0">{{ $resultat->designation }}</p>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            @php
                                                $pourcentage = $resultat->montant > 0 ? ($resultat->montant_execute / $resultat->montant) * 100 : 0;
                                            @endphp
                                            @if($pourcentage >= 100)
                                                <span class="badge bg-success badge-status">Terminé</span>
                                            @elseif($pourcentage >= 50)
                                                <span class="badge bg-info badge-status">En cours</span>
                                            @elseif($pourcentage > 0)
                                                <span class="badge bg-warning badge-status">Démarré</span>
                                            @else
                                                <span class="badge bg-secondary badge-status">Non démarré</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-2">
                                            <strong><i data-feather="user" style="width: 16px; height: 16px;"></i> Contribuable :</strong>
                                            {{ $resultat->contribuable->assujeti ?? 'N/A' }}
                                        </p>
                                        <p class="mb-2">
                                            <strong><i data-feather="folder" style="width: 16px; height: 16px;"></i> Budget :</strong>
                                            {{ $resultat->baseTaxable->libelle ?? 'N/A' }}
                                        </p>
                                        <p class="mb-2">
                                            <strong><i data-feather="users" style="width: 16px; height: 16px;"></i> Personnel(s) :</strong>
                                            {{ $resultat->details->count() }} personne(s) affectée(s)
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-2">
                                            <strong><i data-feather="calendar" style="width: 16px; height: 16px;"></i> Date début :</strong>
                                            {{ $resultat->date_debut ? \Carbon\Carbon::parse($resultat->date_debut)->format('d/m/Y') : 'Non définie' }}
                                        </p>
                                        <p class="mb-2">
                                            <strong><i data-feather="calendar" style="width: 16px; height: 16px;"></i> Date clôture :</strong>
                                            {{ $resultat->date_cloture ? \Carbon\Carbon::parse($resultat->date_cloture)->format('d/m/Y') : 'Non définie' }}
                                        </p>
                                        <p class="mb-2">
                                            <strong><i data-feather="activity" style="width: 16px; height: 16px;"></i> Diligences :</strong>
                                            {{ $resultat->diligences->count() }} diligence(s)
                                        </p>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="text-center p-3" style="background: #f8f9fa; border-radius: 8px;">
                                            <small class="text-muted">Montant Total</small>
                                            <h5 class="mb-0 text-primary">{{ number_format($resultat->montant, 0, ',', ' ') }} FCFA</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center p-3" style="background: #d4edda; border-radius: 8px;">
                                            <small class="text-muted">Montant Exécuté</small>
                                            <h5 class="mb-0 text-success">{{ number_format($resultat->montant_execute, 0, ',', ' ') }} FCFA</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center p-3" style="background: #fff3cd; border-radius: 8px;">
                                            <small class="text-muted">Reste à Exécuter</small>
                                            <h5 class="mb-0 text-warning">{{ number_format($resultat->reste, 0, ',', ' ') }} FCFA</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span><strong>Progression</strong></span>
                                        <span><strong>{{ number_format($pourcentage, 2) }}%</strong></span>
                                    </div>
                                    <div class="progress progress-custom">
                                        <div class="progress-bar
                                            @if($pourcentage >= 100) bg-success
                                            @elseif($pourcentage >= 50) bg-info
                                            @elseif($pourcentage > 0) bg-warning
                                            @else bg-secondary
                                            @endif"
                                            role="progressbar"
                                            style="width: {{ min($pourcentage, 100) }}%"
                                            aria-valuenow="{{ $pourcentage }}"
                                            aria-valuemin="0"
                                            aria-valuemax="100">
                                            {{ number_format($pourcentage, 1) }}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

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
