
<!-- Modal -->
<div class="modal fade" id="enteteModal{{ $fournisseur->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="exampleModalLabel">Information du fournisseur</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('module_fornisseur.update', [$fournisseur->id]) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Libelle</label>
                                <input class="form-control" name="denomination" value="{{ $fournisseur->libelle }}" type="text" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">N° IFU</label>
                                <input class="form-control" name="ifu" value="{{ $fournisseur->ifu }}" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Téléphone</label>
                                <input class="form-control" name="telephone" value="{{ $fournisseur->telephone }}"
                                    type="number" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">RCCM</label>
                                <input class="form-control" name="rccm" value="{{ $fournisseur->rccm }}" type="text" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Adresse</label>
                                <input class="form-control" name="email" value="{{ $fournisseur->adresse }}" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="m-3">
                        <button class="btn btn-1" type="submit">
                            <i class="fas fa-edit"></i>
                            &nbsp; &nbsp;Modifier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
