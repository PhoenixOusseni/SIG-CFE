<!-- Modal -->
<div class="modal fade" id="addElementModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ajout des elements à la facture N°{{ $factures->id }}</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add_facture_element') }}" method="POST">
                    @csrf
                    <fieldset class="w-100 p-2 mt-3" style="border-radius: 5px; background: rgb(219, 238, 221)">
                        <div class="row">
                            <input class="form-control" name="facture_fournisseurs_id" value="{{ $factures->id }}"
                                type="text" hidden />
                            <div class="col-lg-6 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Designation</label>
                                    <input class="form-control" name="designation" type="text" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Quantité</label>
                                    <input class="form-control" name="quantite" type="number" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Prix unitaire</label>
                                    <input class="form-control" name="prix_unitaire" type="number" />
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="m-3">
                        <button class="btn btn-1" type="submit">
                            <i class="fas fa-plus"></i>
                            &nbsp; &nbsp;Ajouter un ligne
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
