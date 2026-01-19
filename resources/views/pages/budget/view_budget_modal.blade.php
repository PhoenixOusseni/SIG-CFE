
<!-- Modal -->
<div class="modal fade" id="enteteModal{{ $budget->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">Information du budget</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('module_budget.update', [$budget->id]) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Code</label>
                                <input class="form-control" name="code" value="{{ $budget->code }}" type="text" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Libelle</label>
                                <input class="form-control" name="libelle" value="{{ $budget->libelle }}" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Dotation</label>
                                <input class="form-control" name="dotation" value="{{ $budget->dotation }}" type="number" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Type de recette</label>
                                <select name="type" class="form-control">
                                    <option value="Recette">Recette</option>
                                    <option value="Dépense">Dépense</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="m-3">
                        <button class="btn btn-1" type="submit">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
