
<!-- Modal -->
<div class="modal fade" id="enteteModal{{ $recette->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">Information de la recette N° {{ $recette->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('module_ordre_recette.update', [$recette->id]) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <fieldset class="w-100 p-2" style="border-radius: 5px; background: rgb(234, 233, 233)">
                        <div class="row">
                            <input class="form-control" name="statut" type="text" value="en attente" hidden />
                            <div class="col-lg-4 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">N° ordre de recette</label>
                                    <input class="form-control" type="text" readonly />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Budget</label>
                                    <select name="budgets_id" class="form-control">
                                        <option value="{{ $recette->Budget->id }}">{{ $recette->Budget->libelle }}</option>
                                        @foreach ($budgets as $budget)
                                            <option value="{{ $budget->id }}">{{ $budget->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Contribuable</label>
                                    <select name="contribuables_id" class="form-control">
                                        <option value="{{ $recette->Contribuable->id }}">{{ $recette->Contribuable->assujeti }}</option>
                                        @foreach ($contribuables as $contribuable)
                                            <option value="{{ $contribuable->id }}">{{ $contribuable->assujeti }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Objet</label>
                                    <input class="form-control" name="objet" type="text" value="{{ $recette->objet }}" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Date</label>
                                    <input class="form-control" name="date" type="text" value="{{ $recette->date }}" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Période</label>
                                    <input class="form-control" name="periode" type="text" value="{{ $recette->periode }}" />
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="w-100 p-2 mt-3" style="border-radius: 5px; background: rgb(219, 238, 221)">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Designation</label>
                                    <select class="form-control" name="base_taxables_id">
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
                                    <select class="form-control" name="source_prelevements_id">
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
                                    <input class="form-control" name="montant" type="number" />
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="m-3">
                        <button class="btn btn-1" type="submit">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
