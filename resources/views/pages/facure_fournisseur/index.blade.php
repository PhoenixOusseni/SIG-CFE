@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Facture fournisseur</title>
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
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Gestion des facture sous-traitant
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->

        <div class="container-xl px-4 mt-n10" style="margin-bottom: 8rem;">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Ajouter une facture sous-traitant</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Erreur(s) de validation :</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('module_facture_fournisseur.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card card-default">
                            <div class="card-body">
                                <fieldset class="w-100 p-2" style="border-radius: 5px; background: rgb(234, 233, 233)">
                                    <div class="row">
                                        <input class="form-control" name="statut" type="text" value="en attente"
                                            hidden />
                                        <input class="form-control" name="users_id" type="text"
                                            value="{{ Auth::user()->id }}" hidden />
                                        <div class="col-lg-5 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Prestation <span class="text-danger">*</span></label>
                                                <select name="base_taxable_id" class="form-select @error('base_taxable_id') is-invalid @enderror" required>
                                                    <option value="">Sélectionner la prestation</option>
                                                    @foreach ($prestations as $prestation)
                                                        <option value="{{ $prestation->id }}" {{ old('base_taxable_id') == $prestation->id ? 'selected' : '' }}>
                                                            {{ $prestation->libelle }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('base_taxable_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Fournisseur <span class="text-danger">*</span></label>
                                                <select name="fournisseur_id" class="form-select @error('fournisseur_id') is-invalid @enderror" required>
                                                    <option value="">Sélectionner le fournisseur</option>
                                                    @foreach ($fournisseurs as $fourn)
                                                        <option value="{{ $fourn->id }}" {{ old('fournisseur_id') == $fourn->id ? 'selected' : '' }}>
                                                            {{ $fourn->libelle }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('fournisseur_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Date <span class="text-danger">*</span></label>
                                                <input class="form-control @error('date') is-invalid @enderror" type="date" name="date" value="{{ old('date') }}" required />
                                                @error('date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Objet</label>
                                                <input class="form-control @error('objet') is-invalid @enderror" type="text" name="objet" value="{{ old('objet') }}" />
                                                @error('objet')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">TVA (%)</label>
                                                <input class="form-control @error('tva') is-invalid @enderror" type="number" name="tva" value="{{ old('tva', 0) }}" min="0" max="100" step="0.01" />
                                                @error('tva')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Signataire <span class="text-danger">*</span></label>
                                                <select name="signataires_id" class="form-select @error('signataires_id') is-invalid @enderror" required>
                                                    <option value="">Sélectionner le signataire</option>
                                                    @foreach (App\Models\Signataire::all() as $signataire)
                                                        <option value="{{ $signataire->id }}" {{ old('signataires_id') == $signataire->id ? 'selected' : '' }}>
                                                            {{ $signataire->nom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('signataires_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="w-100 p-2 mt-3" style="border-radius: 5px; background: #bdcff25c">
                                    <legend class="small">Éléments de la facture</legend>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="elementsTable">
                                            <thead>
                                                <tr>
                                                    <th width="45%">Désignation</th>
                                                    <th width="15%">Quantité</th>
                                                    <th width="20%">Prix unitaire</th>
                                                    <th width="15%">Montant total</th>
                                                    <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="elementsBody">
                                                <tr class="element-row">
                                                    <td>
                                                        <input class="form-control" name="designation[]" type="text" required />
                                                    </td>
                                                    <td>
                                                        <input class="form-control quantite" name="quantite[]" type="number" min="1" value="1" required />
                                                    </td>
                                                    <td>
                                                        <input class="form-control prix_unitaire" name="prix_unitaire[]" type="number" min="0" step="0.01" required />
                                                    </td>
                                                    <td>
                                                        <input class="form-control montant_total" name="montant_total[]" type="number" readonly />
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-danger btn-sm remove-row" disabled>
                                                            <i data-feather="trash-2"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5">
                                                        <button type="button" class="btn btn-primary btn-sm" id="addRowBtn">
                                                            <i data-feather="plus"></i>&thinsp;&thinsp; Ajouter une ligne
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="m-3">
                                <button class="btn btn-1" type="submit">
                                    <i class="fas fa-save"></i>
                                    &nbsp; &nbsp; Enregistrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="container-xl px-4 mt-n10">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Tabbed dashboard card example-->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Tabbed dashboard card example-->
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="sbp-preview-content">
                                                <table id="datatablesSimple">
                                                    <thead>
                                                        <tr>
                                                            <th>N°</th>
                                                            <th>Date</th>
                                                            <th>Budget</th>
                                                            <th>Fournisseur</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($collection as $fact)
                                                            <tr>
                                                                <td>{{ $fact->id }}</td>
                                                                <td>{{ $fact->date }}</td>
                                                                <td>{{ $fact->BaseTaxable->libelle }}</td>
                                                                <td>{{ $fact->Fournisseur->libelle }}</td>
                                                                <td class="d-flex justify-content-center">
                                                                    <a
                                                                        href="{{ route('module_facture_fournisseur.show', [$fact->id]) }}">
                                                                        <i class="fa fa-eye text-success"
                                                                            aria-hidden="true"></i>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fonction pour calculer le montant total d'une ligne
        function calculateRowTotal(row) {
            const quantite = parseFloat(row.querySelector('.quantite').value) || 0;
            const prixUnitaire = parseFloat(row.querySelector('.prix_unitaire').value) || 0;
            const montantTotal = quantite * prixUnitaire;
            row.querySelector('.montant_total').value = montantTotal.toFixed(2);
            calculateGrandTotal();
        }

        // Fonction pour calculer le total général
        function calculateGrandTotal() {
            let total = 0;
            document.querySelectorAll('.montant_total').forEach(function(input) {
                total += parseFloat(input.value) || 0;
            });
            document.getElementById('totalHT').value = total.toFixed(2) + ' FCFA';
        }

        // Fonction pour mettre à jour les boutons de suppression
        function updateRemoveButtons() {
            const rows = document.querySelectorAll('.element-row');
            const removeButtons = document.querySelectorAll('.remove-row');

            removeButtons.forEach(function(button, index) {
                button.disabled = rows.length === 1;
            });
        }

        // Ajouter une nouvelle ligne
        document.getElementById('addRowBtn').addEventListener('click', function() {
            const tbody = document.getElementById('elementsBody');
            const newRow = document.querySelector('.element-row').cloneNode(true);

            // Réinitialiser les valeurs
            newRow.querySelectorAll('input').forEach(function(input) {
                if (!input.classList.contains('montant_total')) {
                    input.value = input.name === 'quantite[]' ? '1' : '';
                } else {
                    input.value = '';
                }
            });

            tbody.appendChild(newRow);

            // Réinitialiser les icônes Feather
            if (typeof feather !== 'undefined') {
                feather.replace();
            }

            updateRemoveButtons();
            attachRowEvents(newRow);
        });

        // Attacher les événements à une ligne
        function attachRowEvents(row) {
            // Événements pour le calcul automatique
            row.querySelector('.quantite').addEventListener('input', function() {
                calculateRowTotal(row);
            });

            row.querySelector('.prix_unitaire').addEventListener('input', function() {
                calculateRowTotal(row);
            });

            // Événement pour supprimer la ligne
            row.querySelector('.remove-row').addEventListener('click', function() {
                if (document.querySelectorAll('.element-row').length > 1) {
                    row.remove();
                    calculateGrandTotal();
                    updateRemoveButtons();
                }
            });
        }

        // Attacher les événements à toutes les lignes existantes
        document.querySelectorAll('.element-row').forEach(function(row) {
            attachRowEvents(row);
        });

        // Initialiser le bouton de suppression
        updateRemoveButtons();
    });
</script>
@endsection
