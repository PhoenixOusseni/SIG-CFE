@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Détails Facture Fournisseur N°{{ $factures->id }}</title>
@endsection

@section('style')
    @include('partials.style')
    <style>
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #2f663f;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .info-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
        }

        .info-value {
            color: #212529;
            font-size: 1.05rem;
        }

        .status-badge {
            font-size: 0.9rem;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
        }

        .status-en-attente {
            background: #fff3cd;
            color: #856404;
        }

        .status-valide {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-en-reglement {
            background: #d4edda;
            color: #155724;
        }

        .status-reglee {
            background: #28a745;
            color: white;
        }

        .total-section {
            background: linear-gradient(135deg, #2f663f 0%, #1e4229 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .total-row:last-child {
            border-bottom: none;
            font-size: 1.3rem;
            font-weight: bold;
            margin-top: 10px;
        }

        .btn-action-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-icon {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .action-icon:hover {
            transform: scale(1.2);
        }

        @media print {

            .btn-action-group,
            .card-header {
                display: none;
            }
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
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Détails Facture Fournisseur N°{{ $factures->id }}
                            </h1>
                        </div>
                        <div class="col-auto mt-4">
                            <a href="{{ route('module_facture_fournisseur.index') }}" class="btn btn-light">
                                <i data-feather="arrow-left"></i> Retour
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-n10" style="margin-bottom: 8rem;">
            <!-- Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <div class="btn-action-group">
                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('print_facture_fourn/' . $factures->id) }}" class="btn btn-success" target="_blank">
                            <i class="fas fa-print"></i>
                        </a>
                        <a href="{{ url('supp_facture_fournisseur/' . $factures->id) }}" class="btn btn-danger"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette facture ?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Informations générales -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <i data-feather="info"></i> Informations Générales
                        </div>
                        <div class="card-body">
                            <div class="info-box">
                                <div class="info-label">Date de la facture</div>
                                <div class="info-value">
                                    <i data-feather="calendar" style="width: 16px; height: 16px;"></i>
                                    {{ \Carbon\Carbon::parse($factures->date)->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="info-box">
                                <div class="info-label">Objet</div>
                                <div class="info-value">
                                    {{ $factures->objet ?? 'Non spécifié' }}
                                </div>
                            </div>

                            <div class="info-box">
                                <div class="info-label">Prestation</div>
                                <div class="info-value">
                                    <i data-feather="briefcase" style="width: 16px; height: 16px;"></i>
                                    {{ $factures->BaseTaxable->libelle ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="info-box">
                                <div class="info-label">TVA</div>
                                <div class="info-value">
                                    {{ number_format($factures->tva ?? 0, 2) }} %
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <i data-feather="users"></i> Fournisseur & Signataire
                        </div>
                        <div class="card-body">
                            <div class="info-box">
                                <div class="info-label">Fournisseur</div>
                                <div class="info-value">
                                    <i data-feather="truck" style="width: 16px; height: 16px;"></i>
                                    {{ $factures->Fournisseur->libelle ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="info-box">
                                <div class="info-label">Signataire</div>
                                <div class="info-value">
                                    <i data-feather="edit-3" style="width: 16px; height: 16px;"></i>
                                    {{ $factures->Signataire->nom ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="info-box">
                                <div class="info-label">Statut</div>
                                <div class="info-value">
                                    <span class="status-badge status-{{ str_replace(' ', '-', $factures->statut) }}">
                                        {{ strtoupper($factures->statut) }}
                                    </span>
                                </div>
                            </div>

                            @if ($factures->statut !== 'en attente')
                                <div class="alert alert-info mt-3">
                                    <strong>Informations de retenue :</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Retenue BIC :
                                            <strong>{{ number_format($factures->retenu_bic ?? 0, 0, ',', ' ') }}
                                                FCFA</strong></li>
                                        <li>Retenue ARCOP :
                                            <strong>{{ number_format($factures->retenu_arcop ?? 0, 0, ',', ' ') }}
                                                FCFA</strong></li>
                                        <li>Pénalité : <strong>{{ number_format($factures->penalite ?? 0, 0, ',', ' ') }}
                                                FCFA</strong></li>
                                        <li>Total retenu :
                                            <strong>{{ number_format($factures->total_retenu ?? 0, 0, ',', ' ') }}
                                                FCFA</strong></li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Éléments de la facture -->
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <i data-feather="list"></i> Éléments de la facture ({{ count($elements) }} ligne(s))
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="35%">Désignation</th>
                                    <th width="12%" class="text-center">Quantité</th>
                                    <th width="16%" class="text-end">Prix Unitaire</th>
                                    <th width="16%" class="text-end">Montant Total</th>
                                    <th width="16%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($elements as $index => $elmnt)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $elmnt->designation }}</td>
                                        <td class="text-center">{{ number_format($elmnt->quantite, 0, ',', ' ') }}</td>
                                        <td class="text-end">{{ number_format($elmnt->prix_unitaire, 0, ',', ' ') }} FCFA
                                        </td>
                                        <td class="text-end">
                                            <strong>{{ number_format($elmnt->montant_total, 0, ',', ' ') }} FCFA</strong>
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <a href="#" class="text-primary me-2 action-icon" data-bs-toggle="modal"
                                                data-bs-target="#editElementModal{{ $elmnt->id }}" title="Modifier">
                                                <i data-feather="edit" style="width: 18px; height: 18px;"></i>
                                            </a>
                                            <a href="{{ url('supp_element_facture_fournisseur/' . $elmnt->id) }}"
                                                class="text-danger action-icon"
                                                onclick="return confirm('Supprimer cet élément ?')" title="Supprimer">
                                                <i data-feather="trash-2" style="width: 18px; height: 18px;"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal d'édition pour cet élément -->
                                    <div class="modal fade" id="editElementModal{{ $elmnt->id }}" tabindex="-1"
                                        aria-labelledby="editElementModalLabel{{ $elmnt->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title"
                                                        id="editElementModalLabel{{ $elmnt->id }}">
                                                        <i class="fas fa-edit"></i> Modifier l'élément
                                                        #{{ $index + 1 }}
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('update_facture_element', $elmnt->id) }}"
                                                    method="POST" id="editElementForm{{ $elmnt->id }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label">Désignation <span
                                                                        class="text-danger">*</span></label>
                                                                <input class="form-control" name="designation"
                                                                    type="text" value="{{ $elmnt->designation }}"
                                                                    placeholder="Description de l'élément" required />
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">Quantité <span
                                                                        class="text-danger">*</span></label>
                                                                <input class="form-control edit-quantite" name="quantite"
                                                                    type="number" data-element-id="{{ $elmnt->id }}"
                                                                    min="1" step="1"
                                                                    value="{{ $elmnt->quantite }}" required />
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">Prix unitaire (FCFA) <span
                                                                        class="text-danger">*</span></label>
                                                                <input class="form-control edit-prix" name="prix_unitaire"
                                                                    type="number" data-element-id="{{ $elmnt->id }}"
                                                                    min="0" step="0.01"
                                                                    value="{{ $elmnt->prix_unitaire }}" required />
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">Montant total (FCFA)</label>
                                                                <input class="form-control bg-light edit-montant"
                                                                    type="text"
                                                                    id="edit_montant_total_{{ $elmnt->id }}" readonly
                                                                    value="{{ number_format($elmnt->montant_total, 0, ',', ' ') }} FCFA" />
                                                            </div>
                                                        </div>

                                                        <div class="alert alert-info">
                                                            <i class="fas fa-info-circle"></i>
                                                            <strong>Note :</strong> Le montant total sera recalculé
                                                            automatiquement (Quantité × Prix unitaire)
                                                        </div>
                                                    </div>

                                                    <div class="m-3">
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="fas fa-save"></i>&nbsp; Enregistrer les modifications
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">
                                                            <i class="fas fa-times"></i>&nbsp; Annuler
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i data-feather="inbox" style="width: 48px; height: 48px; color: #ccc;"></i>
                                            <p class="mt-2 mb-0 text-muted">Aucun élément dans cette facture</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Totaux -->
                    <div class="total-section">
                        <div class="total-row">
                            <span>Sous-total (éléments) :</span>
                            <span>{{ number_format($elements->sum('montant_total'), 0, ',', ' ') }} FCFA</span>
                        </div>

                        @if ($factures->total_retenu > 0)
                            <div class="total-row">
                                <span>Total retenues :</span>
                                <span>- {{ number_format($tota_ret, 0, ',', ' ') }} FCFA</span>
                            </div>
                        @endif

                        <div class="total-row">
                            <span>Total HT :</span>
                            <span>{{ number_format($total_ht, 0, ',', ' ') }} FCFA</span>
                        </div>

                        @if ($factures->tva > 0)
                            <div class="total-row">
                                <span>TVA ({{ number_format($factures->tva, 2) }}%) :</span>
                                <span>{{ number_format(($elements->sum('montant_total') * $factures->tva) / 100, 0, ',', ' ') }}
                                    FCFA</span>
                            </div>
                        @endif

                        <div class="total-row">
                            <span>TOTAL TTC :</span>
                            <span>{{ number_format($total_ttc, 0, ',', ' ') }} FCFA</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historique -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <i data-feather="clock"></i> Historique
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Créée le :</strong>
                                {{ \Carbon\Carbon::parse($factures->created_at)->format('d/m/Y à H:i:s') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Dernière modification :</strong>
                                {{ \Carbon\Carbon::parse($factures->updated_at)->format('d/m/Y à H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('pages.facure_fournisseur.add_element_modal')
        @include('pages.facure_fournisseur.editRecette_modal')
    </main>
@endsection

@section('script')
    <script>
        // Initialiser les icônes Feather
        if (typeof feather !== 'undefined') {
            feather.replace();
        }

        // Calcul automatique pour les modals d'édition d'éléments
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction pour calculer le montant total dans les modals d'édition
            function calculateEditTotal(elementId) {
                const quantiteInput = document.querySelector(`.edit-quantite[data-element-id="${elementId}"]`);
                const prixInput = document.querySelector(`.edit-prix[data-element-id="${elementId}"]`);
                const montantOutput = document.getElementById(`edit_montant_total_${elementId}`);

                if (quantiteInput && prixInput && montantOutput) {
                    const quantite = parseFloat(quantiteInput.value) || 0;
                    const prix = parseFloat(prixInput.value) || 0;
                    const total = quantite * prix;
                    montantOutput.value = total.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ' FCFA';
                }
            }

            // Attacher les événements à tous les champs de quantité et prix dans les modals d'édition
            document.querySelectorAll('.edit-quantite, .edit-prix').forEach(function(input) {
                input.addEventListener('input', function() {
                    const elementId = this.getAttribute('data-element-id');
                    calculateEditTotal(elementId);
                });
            });
        });
    </script>
@endsection
