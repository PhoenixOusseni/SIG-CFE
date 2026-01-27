<!-- Modal d'édition de facture fournisseur -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editModalLabel">
                    <i class="fas fa-edit"></i> Modifier Facture Fournisseur N°{{ $factures->id }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('module_facture_fournisseur.update', [$factures->id]) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="card card-default border-0">
                        <div class="card-body">
                            <fieldset class="w-100 p-3 mb-3"
                                style="border-radius: 5px; background: rgb(255, 249, 230); border: 1px solid #ffc107;">
                                <legend class="text-warning mb-3"><strong>Informations générales</strong></legend>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <label class="form-label">Prestation<span class="text-danger">*</span></label>
                                        <select name="base_taxable_id" class="form-select" required>
                                            <option value="{{ $factures->BaseTaxable->id }}">
                                                {{ $factures->BaseTaxable->libelle }}</option>
                                            @foreach ($prestations as $prestation)
                                                @if ($prestation->id != $factures->base_taxable_id)
                                                    <option value="{{ $prestation->id }}">{{ $prestation->libelle }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <label class="form-label">Fournisseur <span class="text-danger">*</span></label>
                                        <select name="fournisseur_id" class="form-select" required>
                                            <option value="{{ $factures->Fournisseur->id }}">
                                                {{ $factures->Fournisseur->libelle }}</option>
                                            @foreach ($fournisseurs as $fournisseur)
                                                @if ($fournisseur->id != $factures->fournisseur_id)
                                                    <option value="{{ $fournisseur->id }}">{{ $fournisseur->libelle }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-md-12 mb-3">
                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                        <input class="form-control" name="date" type="date"
                                            value="{{ $factures->date }}" required />
                                    </div>

                                    <div class="col-lg-4 col-md-12 mb-3">
                                        <label class="form-label">TVA (%)</label>
                                        <input class="form-control" name="tva" type="number" min="0"
                                            max="100" step="0.01" value="{{ $factures->tva }}" />
                                    </div>

                                    <div class="col-lg-4 col-md-12 mb-3">
                                        <label class="form-label">Signataire <span class="text-danger">*</span></label>
                                        <select name="signataires_id" class="form-select" required>
                                            <option value="{{ $factures->Signataire->id }}">
                                                {{ $factures->Signataire->nom }}</option>
                                            @foreach (App\Models\Signataire::all() as $signataire)
                                                @if ($signataire->id != $factures->signataires_id)
                                                    <option value="{{ $signataire->id }}">{{ $signataire->nom }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Objet</label>
                                        <textarea class="form-control" name="objet" rows="2">{{ $factures->objet }}</textarea>
                                    </div>
                                </div>
                            </fieldset>

                            @if ($factures->statut !== 'en attente')
                                <fieldset class="w-100 p-3"
                                    style="border-radius: 5px; background: rgb(230, 244, 255); border: 1px solid #17a2b8;">
                                    <legend class="text-info mb-3"><strong>Informations de retenue</strong></legend>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label class="form-label">Retenue BIC (FCFA)</label>
                                            <input class="form-control" name="retenu_bic" type="number" min="0"
                                                step="0.01" value="{{ $factures->retenu_bic }}" />
                                        </div>

                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label class="form-label">Retenue ARCOP (FCFA)</label>
                                            <input class="form-control" name="retenu_arcop" type="number"
                                                min="0" step="0.01" value="{{ $factures->retenu_arcop }}" />
                                        </div>

                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label class="form-label">Pénalité (FCFA)</label>
                                            <input class="form-control" name="penalite" type="number" min="0"
                                                step="0.01" value="{{ $factures->penalite }}" />
                                        </div>

                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label class="form-label">Total retenu (FCFA)</label>
                                            <input class="form-control bg-light" name="total_retenu" type="number"
                                                min="0" step="0.01" value="{{ $factures->total_retenu }}"
                                                readonly />
                                        </div>
                                    </div>
                                </fieldset>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="m-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>&nbsp; Enregistrer les modifications
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>&nbsp; Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
