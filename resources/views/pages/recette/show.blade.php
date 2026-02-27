@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Facturation</title>
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
            border-bottom: 2px solid #315192fa;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .badge-status {
            font-size: 0.9rem;
            padding: 8px 15px;
        }

        .total-amount {
            background: #315192fa;
            color: white;
            padding: 15px;
            border-radius: 5px;
            font-size: 1.3rem;
            font-weight: bold;
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
                                Détails de la facture {{ $recette->code }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->

        <div class="container-xl px-4 mt-n10" style="margin-bottom: 8rem;">
            <!-- Boutons d'action -->
            <div class="card mb-4">
                <div class="card-body">
                    <a href="{{ route('module_ordre_recette.index') }}" class="btn btn-light btn-sm">
                        <i data-feather="arrow-left"></i>&thinsp;&thinsp; Retour à la liste
                    </a>
                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i data-feather="edit"></i>
                    </a>
                    <a href="{{ url('print_ordre_recette/' . $recette->id) }}" class="btn btn-success btn-sm"
                        target="_blank">
                        <i data-feather="printer"></i>
                    </a>
                    <a href="#" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#mailChoiceModal">
                        <i data-feather="mail"></i>
                    </a>
                    <a href="{{ url('supp_ordre_recette/' . $recette->id) }}" class="btn btn-danger btn-sm"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette facture ?')">
                        <i data-feather="trash-2"></i>
                    </a>
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
                        <div class="col-md-4">
                            <div class="info-label">Numéro de facture</div>
                            <div class="info-value">
                                <strong>{{ $recette->code }}</strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Projet</div>
                            <div class="info-value">
                                <strong>{{ $recette->Marche->designation ?? 'N/A' }}</strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Statut</div>
                            <div class="info-value">
                                @if ($recette->statut == 'en attente')
                                    <span class="badge bg-warning badge-status">En attente</span>
                                @elseif($recette->statut == 'valide')
                                    <span class="badge bg-info badge-status">Validé</span>
                                @elseif($recette->statut == 'en reglement')
                                    <span class="badge bg-primary badge-status">En règlement</span>
                                @elseif($recette->statut == 'reglée')
                                    <span class="badge bg-success badge-status">Réglée</span>
                                @else
                                    <span class="badge bg-secondary badge-status">{{ ucfirst($recette->statut) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="info-label">Référence</div>
                            <div class="info-value">{{ $recette->reference }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Ligne de service</div>
                            <div class="info-value">
                                @if ($recette->Service)
                                    <strong>{{ $recette->Service->libelle ?? 'N/A' }}</strong>
                                @else
                                    <span class="text-muted">Non défini</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Catégorie</div>
                            <div class="info-value">
                                @if ($recette->Categorie)
                                    <strong>{{ $recette->Categorie->libelle ?? 'N/A' }}</strong>
                                @else
                                    <span class="text-muted">Non définie</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="info-label">Date de la facture</div>
                            <div class="info-value">
                                <i data-feather="calendar"></i>
                                {{ \Carbon\Carbon::parse($recette->date)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Date d'échéance</div>
                            <div class="info-value">
                                @if ($recette->echeance)
                                    <i data-feather="calendar"></i>
                                    {{ \Carbon\Carbon::parse($recette->echeance)->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">Non définie</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Créé par</div>
                            <div class="info-value">
                                <i data-feather="user"></i> {{ $recette->User->login ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                    @if ($recette->periode_debut || $recette->periode_fin)
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="info-label">Période début</div>
                                <div class="info-value">
                                    @if ($recette->periode_debut)
                                        <i data-feather="calendar"></i>
                                        {{ \Carbon\Carbon::parse($recette->periode_debut)->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">Non définie</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-label">Période fin</div>
                                <div class="info-value">
                                    @if ($recette->periode_fin)
                                        <i data-feather="calendar"></i>
                                        {{ \Carbon\Carbon::parse($recette->periode_fin)->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">Non définie</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-label">Client</div>
                                <div class="info-value">
                                    @if ($recette->Contribuable)
                                        <strong>{{ $recette->Contribuable->assujeti ?? 'N/A' }}</strong>
                                    @else
                                        <span class="text-muted">Non définie</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Éléments de la facture -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="section-title mb-0">
                        <i data-feather="list"></i> Éléments de la facture ({{ $elements->count() }} ligne(s))
                    </h5>
                </div>
                <div class="card-body">
                    @if ($elements->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>N°</th>
                                        <th>Compte</th>
                                        <th>Désignation</th>
                                        <th>Quantité</th>
                                        <th>Prix unitaire</th>
                                        <th>Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($elements as $index => $element)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $element->Base->code ?? 'N/A' }}</strong>
                                            </td>
                                            <td>{{ $element->designation }}</td>
                                            <td>{{ number_format($element->quantite, 0, ',', ' ') }}</td>
                                            <td>{{ number_format($element->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                            <td>
                                                <strong>{{ number_format($element->montant ?? $element->quantite * $element->prix_unitaire, 0, ',', ' ') }}
                                                    FCFA</strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>MONTANT TOTAL :</strong></td>
                                        <td colspan="2">
                                            <div class="total-amount">
                                                {{ number_format($montant_total, 0, ',', ' ') }} FCFA
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center py-4">Aucun élément dans cette facture</p>
                    @endif
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
                                <i data-feather="calendar"></i> {{ $recette->created_at->format('d/m/Y à H:i') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Dernière modification</div>
                            <div class="info-value">
                                <i data-feather="calendar"></i> {{ $recette->updated_at->format('d/m/Y à H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.recette.add_element_modal')
        @include('pages.recette.editRecette_modal')

        <div class="modal fade" id="mailChoiceModal" tabindex="-1" aria-labelledby="mailChoiceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mailChoiceModalLabel">Envoyer par messagerie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <label for="mailRecipient" class="form-label">Choisir le destinataire</label>
                        <select class="form-select" id="mailRecipient">
                            <option value="sylvain.zoungrana@forvismazars.com">sylvain.zoungrana@forvismazars.com</option>
                            <option value="hamade.ouedraogo@forvismazars.com">hamade.ouedraogo@forvismazars.com</option>
                            <option value="amidou.ouedraogo@forvismazars.com">amidou.ouedraogo@forvismazars.com</option>
                            <option value="eric.kinda@forvismazars.com">eric.kinda@forvismazars.com</option>
                        </select>
                    </div>
                    <div class="m-3">
                        <a href="#" id="sendViaDefaultMail" class="btn btn-outline-secondary btn-sm">Application par défaut</a>
                        <a href="#" id="sendViaGmail" class="btn btn-danger btn-sm" target="_blank" rel="noopener noreferrer">Gmail</a>
                        <a href="#" id="sendViaOutlook" class="btn btn-primary btn-sm" target="_blank" rel="noopener noreferrer">Outlook</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var recipientSelect = document.getElementById('mailRecipient');
            var defaultMailLink = document.getElementById('sendViaDefaultMail');
            var gmailLink = document.getElementById('sendViaGmail');
            var outlookLink = document.getElementById('sendViaOutlook');

            if (!recipientSelect || !defaultMailLink || !gmailLink || !outlookLink) {
                return;
            }

            var subject = 'Facture {{ $recette->code }}';
            var body = 'Bonjour,\n\nVeuillez trouver les informations de la facture {{ $recette->code }}.\n\nCordialement.';

            function updateMailLinks() {
                var recipient = recipientSelect.value;
                var encodedRecipient = encodeURIComponent(recipient);
                var encodedSubject = encodeURIComponent(subject);
                var encodedBody = encodeURIComponent(body);

                defaultMailLink.href = 'mailto:' + recipient + '?subject=' + encodedSubject + '&body=' + encodedBody;
                gmailLink.href = 'https://mail.google.com/mail/?view=cm&fs=1&to=' + encodedRecipient + '&su=' +
                    encodedSubject + '&body=' + encodedBody;
                outlookLink.href =
                    'https://outlook.office.com/mail/deeplink/compose?to=' + encodedRecipient + '&subject=' +
                    encodedSubject + '&body=' + encodedBody;
            }

            recipientSelect.addEventListener('change', updateMailLinks);
            updateMailLinks();
        });
    </script>
@endsection
