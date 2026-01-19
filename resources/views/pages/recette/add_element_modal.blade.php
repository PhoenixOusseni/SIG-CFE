<!-- Modal -->
<div class="modal fade" id="addElementModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-light" id="exampleModalLabel">Ajout des elements de la recette N°{{ $recette->id }}</h5>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add_element_recette') }}" method="POST">
                    @csrf
                    <fieldset class="w-100 p-2 mt-3" style="border-radius: 5px; background: rgb(219, 238, 221)">
                        <div class="row">
                            <input class="form-control" name="recettes_id" value="{{ $recette->id }}" type="text"
                                hidden />
                            <div class="col-lg-4 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Designation</label>
                                    <select class="form-select" name="base_taxables_id">
                                        <option>Sélectionner la désignation</option>
                                        @foreach ($bases as $item)
                                            <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Quantité</label>
                                    <input class="form-control" name="quantite" type="number" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Prix unitaire</label>
                                    <input class="form-control" name="prix_unitaire" type="number" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Source</label>
                                    <select class="form-select" name="source_prelevements_id">
                                        <option>Sélectionner la source</option>
                                        @foreach ($sources as $item)
                                            <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Uinité</label>
                                    <input class="form-control" name="unite" type="text" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Prix total</label>
                                    <input class="form-control" type="number" readonly />
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="m-3">
                        <button class="btn btn-1" type="submit">
                            <i class="fas fa-plus"></i>
                            &nbsp; &nbsp; Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
