<!-- Modal -->
<div class="modal fade" id="addElementModal" tabindex="-1" aria-labelledby="addElementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addElementModalLabel">
                    <i class="fas fa-plus-circle"></i> Ajouter un élément à la facture N°{{ $factures->id }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('add_facture_element') }}" method="POST" id="addElementForm">
                @csrf
                <div class="modal-body">
                    <input class="form-control" name="facture_fournisseurs_id" value="{{ $factures->id }}"
                        type="hidden" />

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">Désignation <span class="text-danger">*</span></label>
                            <input class="form-control @error('designation') is-invalid @enderror" name="designation"
                                type="text" placeholder="Description de l'élément" required />
                            @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Quantité <span class="text-danger">*</span></label>
                            <input class="form-control @error('quantite') is-invalid @enderror" name="quantite"
                                type="number" id="modal_quantite" min="1" step="1" value="1"
                                placeholder="1" required />
                            @error('quantite')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Prix unitaire (FCFA) <span class="text-danger">*</span></label>
                            <input class="form-control @error('prix_unitaire') is-invalid @enderror"
                                name="prix_unitaire" type="number" id="modal_prix_unitaire" min="0"
                                step="0.01" placeholder="0" required />
                            @error('prix_unitaire')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Montant total (FCFA)</label>
                            <input class="form-control bg-light" type="text" id="modal_montant_total" readonly
                                value="0 FCFA" />
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Note :</strong> Le montant total sera calculé automatiquement (Quantité × Prix unitaire)
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ajouter l'élément
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalQuantite = document.getElementById('modal_quantite');
        const modalPrixUnitaire = document.getElementById('modal_prix_unitaire');
        const modalMontantTotal = document.getElementById('modal_montant_total');

        function calculateModalTotal() {
            const quantite = parseFloat(modalQuantite.value) || 0;
            const prixUnitaire = parseFloat(modalPrixUnitaire.value) || 0;
            const total = quantite * prixUnitaire;
            modalMontantTotal.value = total.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ' FCFA';
        }

        if (modalQuantite && modalPrixUnitaire) {
            modalQuantite.addEventListener('input', calculateModalTotal);
            modalPrixUnitaire.addEventListener('input', calculateModalTotal);
        }
    });
</script>
