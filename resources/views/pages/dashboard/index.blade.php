@extends('layouts.master')

@section('title')
    <title>SIG-FORVISMAZARS | Tableau de bord</title>
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
                                <div class="page-header-icon"><i data-feather="activity"></i></div>
                                SIG - FORVISMAZARS | Tableau de bord
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mt-4">
                            <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                                <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                                <div class="form-control ps-0 pointer">
                                    {{ Carbon\Carbon::now()->format('d-m-Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="row">
                <div class="col-xxl-4 col-xl-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body h-100 p-5">
                            <div class="row align-items-center">
                                <div class="col-xl-8 col-xxl-12">
                                    <div class="text-center text-xl-start text-xxl-center mb-4 mb-xl-0 mb-xxl-4">
                                        <h1 style="font-size:25px" class="text-primary">Bienvenue {{ Auth::user()->prenom }}
                                            !</h1>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-xxl-12 text-center"><img class="img-fluid"
                                        src="asset/assets/img/illustrations/at-work.svg" style="max-width: 26rem" /></div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (in_array(Auth::user()->role, ['Administrateur', 'Superviseur']))
                    <div class="col-xxl-8 col-xl-6 mb-4">
                        <div class="card card-header-actions h-100">
                            <div class="card-header">
                                Statistiques
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="text-center mb-3">CA/ Ligne de service</h6>
                                        <canvas id="chartService" height="20"></canvas>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-center mb-3">CA/ Ligne métier</h6>
                                        <canvas id="chartMetier" height="20"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Example Charts for Dashboard Demo-->
            <div class="row">
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">Factures du jour</div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Rérérence</th>
                                        <th>Marché</th>
                                        <th>Contribuable</th>
                                        <th>Echeance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recettes as $recette)
                                        <tr>
                                            <td>{{ $recette->code }}</td>
                                            <td>{{ $recette->reference }}</td>
                                            <td>{{ $recette->Marche->designation ?? 'N/A' }}</td>
                                            <td>{{ $recette->Contribuable->assujeti ?? 'N/A' }}</td>
                                            <td>{{ $recette->echeance }}</td>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('module_ordre_recette.show', [$recette->id]) }}">
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
    </main>
@endsection

@push('scripts')
<script>
    // Vérifier si les variables existent et les éléments DOM sont présents
    if (typeof Chart !== 'undefined' && document.getElementById('chartService') && document.getElementById('chartMetier')) {
        try {
            // Couleurs pour les graphiques
            const colors = ['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728'];

            // Données pour le graphique Service
            const serviceLabels = {!! json_encode(array_keys($statsService ?? [])) !!};
            const serviceData = {!! json_encode(array_values($statsService ?? [])) !!};

            // Données pour le graphique Métier
            const metierLabels = {!! json_encode(array_keys($statsMetier ?? [])) !!};
            const metierData = {!! json_encode(array_values($statsMetier ?? [])) !!};

            // Configuration commune pour les graphiques en camembert
            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 15,
                        fontSize: 12,
                        padding: 15
                    }
                }
            };

            // Graphique Service
            if (serviceLabels.length > 0 && serviceData.length > 0) {
                const ctxService = document.getElementById('chartService').getContext('2d');
                new Chart(ctxService, {
                    type: 'pie',
                    data: {
                        labels: serviceLabels,
                        datasets: [{
                            data: serviceData,
                            backgroundColor: colors,
                            borderColor: '#fff',
                            borderWidth: 2
                        }]
                    },
                    options: chartOptions
                });
            }

            // Graphique Métier
            if (metierLabels.length > 0 && metierData.length > 0) {
                const ctxMetier = document.getElementById('chartMetier').getContext('2d');
                new Chart(ctxMetier, {
                    type: 'pie',
                    data: {
                        labels: metierLabels,
                        datasets: [{
                            data: metierData,
                            backgroundColor: colors,
                            borderColor: '#fff',
                            borderWidth: 2
                        }]
                    },
                    options: chartOptions
                });
            }
        } catch (error) {
            console.warn('Erreur lors du chargement des graphiques:', error);
        }
    }
</script>
@endpush
