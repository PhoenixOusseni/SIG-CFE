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
                                        <h1 style="font-size:25px" class="text-primary">Bienvenue {{ Auth::user()->prenom }} !</h1>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-xxl-12 text-center"><img class="img-fluid"
                                        src="asset/assets/img/illustrations/at-work.svg" style="max-width: 26rem" /></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-xl-6 mb-4">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            Facture client en attente de recouvrement
                        </div>
                        <div class="card-body">
                            <div class="timeline timeline-xs">
                                <!-- Timeline Item 1-->
                                @forelse ($collection as $item)
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-text">{{ $loop->iteration }}</div>
                                            <div class="timeline-item-marker-indicator bg-green"></div>
                                        </div>
                                        <div class="timeline-item-content pt-1 pb-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="fw-bold text-primary small">
                                                    <i class="fa fa-file-text-o me-1"></i>
                                                    {{ $item->reference }}
                                                </span>
                                                <span class="badge bg-warning text-dark small">
                                                    <i class="fa fa-clock-o me-1"></i>
                                                    En recouvrement
                                                </span>
                                            </div>
                                            <div class="d-flex flex-wrap gap-3 mt-1 text-muted small">
                                                <span>
                                                    <i class="fa fa-briefcase me-1 text-secondary"></i>
                                                    {{ $item->Marche->designation ?? 'N/A' }}
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar me-1 text-secondary"></i>
                                                    {{ \Carbon\Carbon::parse($item->echeance)->format('d/m/Y') }}
                                                </span>
                                                <span>
                                                    <i class="fa fa-user me-1 text-secondary"></i>
                                                    {{ $item->Contribuable->assujeti ?? 'N/A' }}
                                                </span>
                                                <span class="fw-semibold text-success">
                                                    <i class="fa fa-money me-1"></i>
                                                    {{ number_format($item->ElementRecette->sum('montant'), 0, ',', ' ') }} FCFA
                                                </span>
                                            </div>
                                            <div class="mt-2">
                                                <a href="{{ route('module_ordre_recette.show', $item->id) }}" class="btn btn-xs btn-outline-primary py-0 px-2" style="font-size:0.75rem">
                                                    <i class="fa fa-eye me-1"></i> Voir détail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted text-center small mt-3">Aucune facture en attente de recouvrement.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Example Charts for Dashboard Demo-->
            <div class="row">
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
                                            <a href="{{ route ('module_ordre_recette.show', [$recette->id]) }}">
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
    </main>
@endsection
