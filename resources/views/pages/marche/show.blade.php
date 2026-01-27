@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Détails du marché</title>
@endsection

@section('style')
    @include('partials.style')
    <style>
        .info-label {
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 1.1rem;
            color: #212529;
            margin-bottom: 15px;
        }

        .section-title {
            border-bottom: 2px solid #28a745;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .file-preview {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .file-link {
            display: inline-block;
            margin-top: 10px;
        }

        .badge-status {
            font-size: 0.9rem;
            padding: 8px 15px;
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
                            Détails du marché
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg-12">
                <!-- Boutons d'action -->
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="{{ route('gestion_marche.index') }}" class="btn btn-primary">
                            <i data-feather="arrow-left"></i>&thinsp;&thinsp; Retour à la liste
                        </a>
                        <a href="{{ route('gestion_marche.edit', $marcheFind->id) }}" class="btn btn-warning">
                            <i data-feather="edit"></i>
                        </a>
                        <a href="{{ route('print_marche', $marcheFind->id) }}" class="btn btn-success">
                            <i data-feather="printer"></i>
                        </a>
                        <button type="button" class="btn btn-danger"
                            onclick="if(confirm('Êtes-vous sûr de vouloir supprimer ce marché ?')) { document.getElementById('delete-form-{{ $marcheFind->id }}').submit(); }">
                            <i data-feather="trash-2"></i>
                        </button>
                        <form id="delete-form-{{ $marcheFind->id }}"
                            action="{{ route('gestion_marche.destroy', $marcheFind->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>

                <!-- Informations générales -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="section-title mb-0">
                            <i data-feather="info"></i> Informations générales
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-label">Code du marché</div>
                                <div class="info-value">{{ $marcheFind->code }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">Montant</div>
                                <div class="info-value text-success">
                                    <strong>{{ number_format($marcheFind->montant, 0, ',', ' ') }} FCFA</strong>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="info-label">Désignation</div>
                                <div class="info-value">{{ $marcheFind->designation }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">Client</div>
                                <div class="info-value">{{ $marcheFind->contribuable->assujeti ?? 'Non défini' }}</div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="info-label">Date de début</div>
                                <div class="info-value">
                                    @if ($marcheFind->date_debut)
                                        <i data-feather="calendar"></i>
                                        {{ \Carbon\Carbon::parse($marcheFind->date_debut)->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">Non définie</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">Date de clôture</div>
                                <div class="info-value">
                                    @if ($marcheFind->date_cloture)
                                        <i data-feather="calendar"></i>
                                        {{ \Carbon\Carbon::parse($marcheFind->date_cloture)->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">Non définie</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if ($marcheFind->date_debut && $marcheFind->date_cloture)
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="info-label">Durée du marché</div>
                                    <div class="info-value">
                                        <span class="badge bg-info badge-status">
                                            {{ \Carbon\Carbon::parse($marcheFind->date_debut)->diffInDays(\Carbon\Carbon::parse($marcheFind->date_cloture)) }}
                                            jours
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Équipe du marché -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="section-title mb-0">
                            <i data-feather="users"></i> Équipe du marché ({{ $marcheFind->details->count() }} membres)
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($marcheFind->details->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Code</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Service</th>
                                            <th>Temps</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($marcheFind->details as $index => $detail)
                                            <tr>
                                                <td>{{ $detail->personnel->code ?? 'N/A' }}</td>
                                                <td>
                                                    <strong>{{ $detail->personnel->nom ?? 'N/A' }}</strong>
                                                </td>
                                                <td>
                                                    {{ $detail->personnel->prenom ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    {{ $detail->personnel->service->libelle ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-primary">{{ $detail->temps ?? 'Non précisé' }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted text-center py-4">Aucun membre dans l'équipe</p>
                        @endif
                    </div>
                </div>

                <!-- Pièces jointes -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="section-title mb-0">
                            <i data-feather="paperclip"></i> Pièces jointes
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if ($marcheFind->pj1)
                                <div class="col-md-4 text-center mb-3">
                                    <div class="info-label">Pièce jointe 1</div>
                                    @php
                                        $extension = pathinfo($marcheFind->pj1, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($extension), [
                                            'jpg',
                                            'jpeg',
                                            'png',
                                            'gif',
                                            'bmp',
                                            'webp',
                                        ]);
                                    @endphp
                                    @if ($isImage)
                                        <img src="{{ asset($marcheFind->pj1) }}" alt="PJ1"
                                            class="file-preview img-thumbnail">
                                    @else
                                        <div class="text-center py-4">
                                            <i data-feather="file" style="width: 80px; height: 80px;"></i>
                                            <p class="mt-2">{{ strtoupper($extension) }}</p>
                                        </div>
                                    @endif
                                    <a href="{{ asset($marcheFind->pj1) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary file-link">
                                        <i data-feather="download"></i> Télécharger
                                    </a>
                                </div>
                            @endif

                            @if ($marcheFind->pj2)
                                <div class="col-md-4 text-center mb-3">
                                    <div class="info-label">Pièce jointe 2</div>
                                    @php
                                        $extension = pathinfo($marcheFind->pj2, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($extension), [
                                            'jpg',
                                            'jpeg',
                                            'png',
                                            'gif',
                                            'bmp',
                                            'webp',
                                        ]);
                                    @endphp
                                    @if ($isImage)
                                        <img src="{{ asset($marcheFind->pj2) }}" alt="PJ2"
                                            class="file-preview img-thumbnail">
                                    @else
                                        <div class="text-center py-4">
                                            <i data-feather="file" style="width: 80px; height: 80px;"></i>
                                            <p class="mt-2">{{ strtoupper($extension) }}</p>
                                        </div>
                                    @endif
                                    <a href="{{ asset($marcheFind->pj2) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary file-link">
                                        <i data-feather="download"></i> Télécharger
                                    </a>
                                </div>
                            @endif

                            @if ($marcheFind->pj3)
                                <div class="col-md-4 text-center mb-3">
                                    <div class="info-label">Pièce jointe 3</div>
                                    @php
                                        $extension = pathinfo($marcheFind->pj3, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($extension), [
                                            'jpg',
                                            'jpeg',
                                            'png',
                                            'gif',
                                            'bmp',
                                            'webp',
                                        ]);
                                    @endphp
                                    @if ($isImage)
                                        <img src="{{ asset($marcheFind->pj3) }}" alt="PJ3"
                                            class="file-preview img-thumbnail">
                                    @else
                                        <div class="text-center py-4">
                                            <i data-feather="file" style="width: 80px; height: 80px;"></i>
                                            <p class="mt-2">{{ strtoupper($extension) }}</p>
                                        </div>
                                    @endif
                                    <a href="{{ asset($marcheFind->pj3) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary file-link">
                                        <i data-feather="download"></i> Télécharger
                                    </a>
                                </div>
                            @endif

                            @if (!$marcheFind->pj1 && !$marcheFind->pj2 && !$marcheFind->pj3)
                                <div class="col-12">
                                    <p class="text-muted text-center py-4">Aucune pièce jointe disponible</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Informations système -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="section-title mb-0">
                            <i data-feather="clock"></i> Informations système
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-label">Date de création</div>
                                <div class="info-value">
                                    <i data-feather="calendar"></i> {{ $marcheFind->created_at->format('d/m/Y à H:i') }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">Dernière modification</div>
                                <div class="info-value">
                                    <i data-feather="calendar"></i> {{ $marcheFind->updated_at->format('d/m/Y à H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
